<?php

/************************************************************************
 * Telaen is a GPL'ed software developed by
 *
 * - The Telaen Group
 * - http://jimjag.github.io/telaen/
 *************************************************************************/

/*
 * class.Mparser.php
 *   Orig impl: <copyright>Copyright � (C) Manuel Lemos 2006 - 2008</copyright>
 *   Modifications for Telaen: Jim Jagielski <jimjag@gmail.com>
 *   License: BSD 2-Clause: http://opensource.org/licenses/BSD-2-Clause
 *
 */
namespace Telaen\Mparser;

define('MIME_PARSER_START', 1);
define('MIME_PARSER_HEADER', 2);
define('MIME_PARSER_HEADER_VALUE', 3);
define('MIME_PARSER_BODY', 4);
define('MIME_PARSER_BODY_START', 5);
define('MIME_PARSER_BODY_DATA', 6);
define('MIME_PARSER_BODY_DONE', 7);
define('MIME_PARSER_END', 8);

define('MIME_MESSAGE_START', 1);
define('MIME_MESSAGE_GET_HEADER_NAME', 2);
define('MIME_MESSAGE_GET_HEADER_VALUE', 3);
define('MIME_MESSAGE_GET_BODY', 4);
define('MIME_MESSAGE_GET_BODY_PART', 5);

define('MIME_ADDRESS_START', 1);
define('MIME_ADDRESS_FIRST', 2);

class Mparser
{

    public $error = '';
    public $error_position = -1;
    public $mbox = 0;
    public $decode_bodies = 1;
    public $message_buffer_length = 2097152;
    public $ignore_syntax_errors = 1;
    public $warnings = [];
    public $track_lines = 0;
    public $use_part_file_names = 0;
    public $custom_mime_types = [];

    /* Private variables */
    private $state = MIME_PARSER_START;
    private $buffer = '';
    private $buffer_position = 0;
    private $offset = 0;
    private $parts = [];
    private $part_position = 0;
    private $headers = [];
    private $body_parser;
    private $body_parser_state = MIME_PARSER_BODY_DONE;
    private $body_buffer = '';
    private $body_buffer_position = 0;
    private $body_offset = 0;
    private $current_header = '';
    private $file;
    private $body_file;
    private $position = 0;
    private $body_part_number = 1;
    private $next_token = '';
    private $lines = [];
    private $line_offset = 0;
    private $last_line = 1;
    private $last_carriage_return = 0;
    private $header_name_characters = '!"#$%&\'()*+,-./0123456789;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}';
    private $message_position = 0;

    /* Private functions */

    private function SetError($error)
    {
        $this->error = $error;
        return false;
    }

    private function SetPositionedError($error, $position)
    {
        $this->error_position = $position;
        return ($this->SetError($error));
    }

    private function SetPositionedWarning($error, $position)
    {
        if (!$this->ignore_syntax_errors) {
            return ($this->SetPositionedError($error, $position));
        }

        $this->warnings[$position] = $error;
        return true;
    }

    private function SetPHPError($error, &$php_error_message)
    {
        if (IsSet($php_error_message) && strlen($php_error_message)) {
            $error .= ': ' . $php_error_message;
        }

        return ($this->SetError($error));
    }

    private function ResetParserState()
    {
        $this->error = '';
        $this->error_position = -1;
        $this->state = MIME_PARSER_START;
        $this->buffer = '';
        $this->buffer_position = 0;
        $this->offset = 0;
        $this->parts = [];
        $this->part_position = 0;
        $this->headers = [];
        $this->body_parser_state = MIME_PARSER_BODY_DONE;
        $this->body_buffer = '';
        $this->body_buffer_position = 0;
        $this->body_offset = 0;
        $this->current_header = '';
        $this->position = 0;
        $this->body_part_number = 1;
        $this->next_token = '';
        $this->lines = ($this->track_lines ? [0 => 0] : []);
        $this->line_offset = 0;
        $this->last_line = 0;
        $this->last_carriage_return = 0;
    }

    private function Tokenize($string, $separator = "")
    {
        if (!strcmp($separator, "")) {
            $separator = $string;
            $string = $this->next_token;
        }
        for ($character = 0; $character < strlen($separator); $character++) {
            if (is_int($position = strpos($string, $separator[$character]))) {
                $found = (IsSet($found) ? min($found, $position) : $position);
            }
        }
        if (IsSet($found)) {
            $this->next_token = substr($string, $found + 1);
            return (substr($string, 0, $found));
        } else {
            $this->next_token = '';
            return ($string);
        }
    }

    private function ParseStructuredHeader($value, &$type, &$parameters, &$character_sets, &$languages)
    {
        $type = strtolower(trim($this->Tokenize($value, ';')));
        $p = trim($this->Tokenize(''));
        $parameters = $character_sets = $languages = [];
        while (strlen($p)) {
            $parameter = trim(strtolower($this->Tokenize($p, '=')));
            $remaining = trim($this->Tokenize(''));
            if (strlen($remaining) && !strcmp($remaining[0], '"') && (is_int($quote = strpos($remaining, '"', 1)))) {
                $value = substr($remaining, 1, $quote - 1);
                $p = trim(substr($remaining, $quote + 1));
                if (strlen($p) > 0 && !strcmp($p[0], ';')) {
                    $p = substr($p, 1);
                }
            } else {
                $value = trim($this->Tokenize($remaining, ';'));
                $p = trim($this->Tokenize(''));
            }
            if (($l = strlen($parameter)) && !strcmp($parameter[$l - 1], '*')) {
                $parameter = $this->Tokenize($parameter, '*');
                if (IsSet($parameters[$parameter]) && IsSet($character_sets[$parameter])) {
                    $value = $parameters[$parameter] . UrlDecode($value);
                } else {
                    $character_sets[$parameter] = strtolower($this->Tokenize($value, '\''));
                    $languages[$parameter] = $this->Tokenize('\'');
                    $value = UrlDecode($this->Tokenize(''));
                }
            }
            $parameters[$parameter] = $value;
        }
    }

    private function FindStringLineBreak($string, $position, &$break, &$line_break)
    {
        if (is_int($line_break = strpos($string, $break = "\r", $position))) {
            if (is_int($new_line_break = strpos($string, "\n", $position))) {
                if ($new_line_break < $line_break) {
                    $break = "\n";
                    $line_break = $new_line_break;
                    return true;
                }
            }
            if ($line_break > $position && $string[$line_break - 1] == "\r") {
                $line_break--;
                $break = "\r\n";
            }
            return true;
        }
        return (is_int($line_break = strpos($string, $break = "\n", $position)));
    }

    private function FindLineBreak($position, &$break, &$line_break)
    {
        if (is_int($line_break = strpos($this->buffer, $break = "\r", $position))) {
            if (is_int($new_line_break = strpos($this->buffer, "\n", $position))) {
                if ($new_line_break < $line_break) {
                    $break = "\n";
                    $line_break = $new_line_break;
                    return true;
                }
            }
            if (($n = $line_break + 1) < strlen($this->buffer) && $this->buffer[$n] == "\n"
            ) {
                $break = "\r\n";
            }

            return true;
        }
        return (is_int($line_break = strpos($this->buffer, $break = "\n", $position)));
    }

    private function FindBodyLineBreak($position, &$break, &$line_break)
    {
        if (is_int($line_break = strpos($this->body_buffer, $break = "\r", $position))) {
            if (is_int($new_line_break = strpos($this->body_buffer, "\n", $position))) {
                if ($new_line_break < $line_break) {
                    $break = "\n";
                    $line_break = $new_line_break;
                    return true;
                }
            }
            if (($n = $line_break + 1) < strlen($this->body_buffer) && $this->body_buffer[$n] == "\n") {
                $break = "\r\n";
            }

            return true;
        }
        return (is_int($line_break = strpos($this->body_buffer, $break = "\n", $position)));
    }

    private function ParseHeaderString($body, &$position, &$headers)
    {
        $l = strlen($body);
        $headers = [];
        for (; $position < $l;) {
            if ($this->FindStringLineBreak($body, $position, $break, $line_break)) {
                $line = substr($body, $position, $line_break - $position);
                $position = $line_break + strlen($break);
            } else {
                $line = substr($body, $position);
                $position = $l;
            }
            if (strlen($line) == 0) {
                break;
            }

            $h = strtolower(strtok($line, ':'));
            $headers[$h] = trim(strtok(''));
        }
    }

    private function ParsePart($end, &$part, &$need_more_data)
    {
        $need_more_data = 0;
        switch ($this->state) {
            case MIME_PARSER_START:
                $part = [
                    'Type' => 'MessageStart',
                    'Position' => $this->offset + $this->buffer_position,
                ];
                $this->state = MIME_PARSER_HEADER;
                break;
            case MIME_PARSER_HEADER:
                if ($this->FindLineBreak($this->buffer_position, $break, $line_break)) {
                    $next = $line_break + strlen($break);
                    if (!strcmp($break, "\r") && strlen($this->buffer) == $next && !$end) {
                        $need_more_data = 1;
                        break;
                    }
                    if ($line_break == $this->buffer_position) {
                        $part = [
                            'Type' => 'BodyStart',
                            'Position' => $this->offset + $this->buffer_position,
                        ];
                        $this->buffer_position = $next;
                        $this->state = MIME_PARSER_BODY;
                        break;
                    }
                }
                if (($break = strspn($this->buffer, $this->header_name_characters, $this->buffer_position) + $this->buffer_position) < strlen($this->buffer)) {
                    switch ($this->buffer[$break]) {
                        case ':':
                            $next = $break + 1;
                            break;
                        case ' ':
                            if (substr($this->buffer, $this->buffer_position, $break - $this->buffer_position) === 'From') {
                                $next = $break + 1;
                                break;
                            }
                        default:
                            if (!$this->SetPositionedWarning('message headers do not end with empty line', $this->buffer_position)) {
                                return false;
                            }

                            $part = [
                                'Type' => 'BodyStart',
                                'Position' => $this->offset + $this->buffer_position,
                            ];
                            $this->state = MIME_PARSER_BODY;
                            break 2;
                    }
                } else {
                    $need_more_data = !$end;
                    if ($end) {
                        $part = [
                            'Type' => 'BodyStart',
                            'Position' => $this->offset + $this->buffer_position,
                        ];
                        $this->state = MIME_PARSER_BODY;
                    }
                    break;
                }

                $part = [
                    'Type' => 'HeaderName',
                    'Name' => substr($this->buffer, $this->buffer_position, $next - $this->buffer_position),
                    'Position' => $this->offset + $this->buffer_position,
                ];
                $this->buffer_position = $next;
                $this->state = MIME_PARSER_HEADER_VALUE;
                break;
            case MIME_PARSER_HEADER_VALUE:
                $position = $this->buffer_position;
                $value = '';
                for (;;) {
                    if ($this->FindLineBreak($position, $break, $line_break)) {
                        $next = $line_break + strlen($break);
                        $line = substr($this->buffer, $position, $line_break - $position);
                        if (strlen($this->buffer) == $next) {
                            if (!$end) {
                                $need_more_data = 1;
                                break 2;
                            }
                            $value .= $line;
                            $part = [
                                'Type' => 'HeaderValue',
                                'Value' => $value,
                                'Position' => $this->offset + $this->buffer_position,
                            ];
                            $this->buffer_position = $next;
                            $this->state = MIME_PARSER_END;
                            break;
                        } else {
                            $character = $this->buffer[$next];
                            if (!strcmp($character, ' ') || !strcmp($character, "\t")) {
                                $value .= $line;
                                $position = $next;
                            } else {
                                $value .= $line;
                                $part = [
                                    'Type' => 'HeaderValue',
                                    'Value' => $value,
                                    'Position' => $this->offset + $this->buffer_position,
                                ];
                                $this->buffer_position = $next;
                                $this->state = MIME_PARSER_HEADER;
                                break 2;
                            }
                        }
                    } else {
                        if (!$end) {
                            $need_more_data = 1;
                            break;
                        } else {
                            $value .= substr($this->buffer, $position);
                            $part = [
                                'Type' => 'HeaderValue',
                                'Value' => $value,
                                'Position' => $this->offset + $this->buffer_position,
                            ];
                            $this->buffer_position = strlen($this->buffer);
                            $this->state = MIME_PARSER_END;
                            break;
                        }
                    }
                }
                break;
            case MIME_PARSER_BODY:
                if ($this->mbox) {
                    $add = 0;
                    $append = '';
                    if ($this->FindLineBreak($this->buffer_position, $break, $line_break)) {
                        $next = $line_break + strlen($break);
                        $following = $next + strlen($break);
                        if ($following >= strlen($this->buffer) || !is_int($line = strpos($this->buffer, $break, $following))) {
                            if (!$end) {
                                $need_more_data = 1;
                                break;
                            }
                        }
                        $start = substr($this->buffer, $next, strlen($break . 'From '));
                        if (!strcmp($break . 'From ', $start)) {
                            if ($line_break == $this->buffer_position) {
                                $part = [
                                    'Type' => 'MessageEnd',
                                    'Position' => $this->offset + $this->buffer_position,
                                ];
                                $this->buffer_position = $following;
                                $this->state = MIME_PARSER_START;
                                break;
                            } else {
                                $add = strlen($break);
                            }

                            $next = $line_break;
                        } elseif (($indent = strspn($this->buffer, '>', $next)) > 0) {
                            $start = substr($this->buffer, $next + $indent, strlen('From '));
                            if (!strcmp('From ', $start)) {
                                $part = [
                                    'Type' => 'BodyData',
                                    'Data' => substr($this->buffer, $this->buffer_position, $next - $this->buffer_position),
                                    'Position' => $this->offset + $this->buffer_position,
                                ];
                                $this->buffer_position = $next + 1;
                                break;
                            }
                        }
                    } else {
                        if (!$end) {
                            $need_more_data = 1;
                            break;
                        }
                        $next = strlen($this->buffer);
                        $append = "\r\n";
                    }
                    if ($next > $this->buffer_position) {
                        $part = [
                            'Type' => 'BodyData',
                            'Data' => substr($this->buffer, $this->buffer_position, $next + $add - $this->buffer_position) . $append,
                            'Position' => $this->offset + $this->buffer_position,
                        ];
                    } elseif ($end) {
                        $part = [
                            'Type' => 'MessageEnd',
                            'Position' => $this->offset + $this->buffer_position,
                        ];
                        $this->state = MIME_PARSER_END;
                    }
                    $this->buffer_position = $next;
                } else {
                    if (strlen($this->buffer) - $this->buffer_position) {
                        $data = substr($this->buffer, $this->buffer_position, strlen($this->buffer) - $this->buffer_position);
                        $end_line = (!strcmp(substr($data, -1), "\n") || !strcmp(substr($data, -1), "\r"));
                        if ($end && !$end_line) {
                            $data .= "\n";
                            $end_line = 1;
                        }
                        $offset = $this->offset + $this->buffer_position;
                        $this->buffer_position = strlen($this->buffer);
                        $need_more_data = !$end;
                        if (!$end_line) {
                            if (is_int($line_break = strrpos($data, "\n")) || is_int($line_break = strrpos($data, "\r"))) {
                                $line_break++;
                                $this->buffer_position -= strlen($data) - $line_break;
                                $data = substr($data, 0, $line_break);
                            }
                        }
                        $part = [
                            'Type' => 'BodyData',
                            'Data' => $data,
                            'Position' => $offset,
                        ];
                    } else {
                        if ($end) {
                            $part = [
                                'Type' => 'MessageEnd',
                                'Position' => $this->offset + $this->buffer_position,
                            ];
                            $this->state = MIME_PARSER_END;
                        } else {
                            $need_more_data = 1;
                        }
                    }
                }
                break;
            default:
                return ($this->SetPositionedError($this->state . ' is not a valid parser state', $this->buffer_position));
        }
        return true;
    }

    private function QueueBodyParts()
    {
        for (;;) {
            if (!$this->body_parser->GetPart($part, $end)) {
                return ($this->SetError($this->body_parser->error));
            }

            if ($end) {
                return true;
            }

            if (!IsSet($part['Part'])) {
                $part['Part'] = $this->headers['Boundary'];
            }

            $this->parts[] = $part;
        }
    }

    private function ParseParameters($value, &$first, &$parameters, $return)
    {
        $first = strtolower(trim(strtok($value, ';')));
        $values = trim(strtok(''));
        $parameters = [];
        $return_value = '';
        while (strlen($values)) {
            $parameter = trim(strtolower(strtok($values, '=')));
            $value = trim(strtok(';'));
            $l = strlen($value);
            if ($l > 1 && !strcmp($value[0], '"') && !strcmp($value[$l - 1], '"')) {
                $value = substr($value, 1, $l - 2);
            }

            $parameters[$parameter] = $value;
            if (!strcmp($parameter, $return)) {
                $return_value = $value;
            }

            $values = trim(strtok(''));
        }
        return ($return_value);
    }

    private function ParseBody($data, $end, $offset)
    {
        $success = $this->body_parser->Parse($data, $end);
        $tw = count($this->body_parser->warnings);
        for (Reset($this->body_parser->warnings), $w = 0; $w < $tw; ++$w, Next($this->body_parser->warnings)) {
            $position = Key($this->body_parser->warnings);
            $this->SetPositionedWarning($this->body_parser->warnings[$position], $offset + $position + $this->body_parser->message_position);
        }
        if (!$success) {
            if (($this->error_position = $this->body_parser->error_position) != -1) {
                $this->body_parser->error_position += $offset + $this->body_parser->message_position;
            }

            return ($this->SetError($this->body_parser->error));
        }
        return true;
    }

    private function DecodePart($part)
    {
        switch ($part['Type']) {
            case 'MessageStart':
                $this->headers = [];
                break;
            case 'HeaderName':
                if ($this->decode_bodies) {
                    $this->current_header = strtolower($part['Name']);
                }

                break;
            case 'HeaderValue':
                if ($this->decode_bodies) {
                    switch ($this->current_header) {
                        case 'content-type:':
                            $boundary = $this->ParseParameters($part['Value'], $type, $parameters, 'boundary');
                            $this->headers['Type'] = $type;
                            if (!strcmp(strtok($type, '/'), 'multipart')) {
                                $this->headers['Multipart'] = 1;
                                if (strlen($boundary)) {
                                    $this->headers['Boundary'] = $boundary;
                                } else {
                                    return ($this->SetPositionedError('multipart content-type header does not specify the boundary parameter', $part['Position']));
                                }
                            }
                            break;
                        case 'content-transfer-encoding:':
                            switch ($this->headers['Encoding'] = strtolower(trim($part['Value']))) {
                                case 'quoted-printable':
                                    $this->headers['QuotedPrintable'] = 1;
                                    break;
                                case '7 bit':
                                case '8 bit':
                                    if (!$this->SetPositionedWarning('"' . $this->headers['Encoding'] . '" is an incorrect content transfer encoding type', $part['Position'])) {
                                        return false;
                                    }

                                case '7bit':
                                case '8bit':
                                case 'binary':
                                    break;
                                case 'base64':
                                    $this->headers['Base64'] = 1;
                                    break;
                                default:
                                    if (!$this->SetPositionedWarning('decoding ' . $this->headers['Encoding'] . ' encoded bodies is not yet supported', $part['Position'])) {
                                        return false;
                                    }
                            }
                            break;
                    }
                }
                break;
            case 'BodyStart':
                if ($this->decode_bodies && IsSet($this->headers['Multipart'])) {
                    $this->body_parser_state = MIME_PARSER_BODY_START;
                    $this->body_buffer = '';
                    $this->body_buffer_position = 0;
                }
                break;
            case 'MessageEnd':
                if ($this->decode_bodies && IsSet($this->headers['Multipart']) && $this->body_parser_state != MIME_PARSER_BODY_DONE) {
                    if ($this->body_parser_state != MIME_PARSER_BODY_DATA) {
                        return ($this->SetPositionedError('incomplete message body part', $part['Position']));
                    }

                    if (!$this->SetPositionedWarning('truncated message body part', $part['Position'])) {
                        return false;
                    }
                }
                break;
            case 'BodyData':
                if ($this->decode_bodies) {
                    if (strlen($this->body_buffer) == 0) {
                        $this->body_buffer = $part['Data'];
                        $this->body_offset = $part['Position'];
                    } else {
                        $this->body_buffer .= $part['Data'];
                    }

                    if (IsSet($this->headers['Multipart'])) {
                        $boundary = '--' . $this->headers['Boundary'];
                        switch ($this->body_parser_state) {
                            case MIME_PARSER_BODY_START:
                                for ($position = $this->body_buffer_position;;) {
                                    if (!$this->FindBodyLineBreak($position, $break, $line_break)) {
                                        return true;
                                    }

                                    $next = $line_break + strlen($break);
                                    if (!strcmp(rtrim(substr($this->body_buffer, $position, $line_break - $position)), $boundary)) {
                                        $part = [
                                            'Type' => 'StartPart',
                                            'Part' => $this->headers['Boundary'],
                                            'Position' => $this->body_offset + $next,
                                        ];
                                        $this->parts[] = $part;
                                        UnSet($this->body_parser);
                                        $this->body_parser = new Mparser();
                                        $this->body_parser->decode_bodies = 1;
                                        $this->body_parser->mbox = 0;
                                        $this->body_parser_state = MIME_PARSER_BODY_DATA;
                                        $this->body_buffer = substr($this->body_buffer, $next);
                                        $this->body_offset += $next;
                                        $this->body_buffer_position = 0;
                                        break;
                                    } else {
                                        $position = $next;
                                    }
                                }
                            case MIME_PARSER_BODY_DATA:
                                for ($position = $this->body_buffer_position;;) {
                                    if (!$this->FindBodyLineBreak($position, $break, $line_break)) {
                                        if ($position > 0) {
                                            if (!$this->ParseBody(substr($this->body_buffer, 0, $position), 0, $this->body_offset)) {
                                                return false;
                                            }

                                            if (!$this->QueueBodyParts()) {
                                                return false;
                                            }
                                        }
                                        $this->body_buffer = substr($this->body_buffer, $position);
                                        $this->body_buffer_position = 0;
                                        $this->body_offset += $position;
                                        return true;
                                    }
                                    $next = $line_break + strlen($break);
                                    $line = rtrim(substr($this->body_buffer, $position, $line_break - $position));
                                    if (!strcmp($line, $boundary . '--')) {
                                        if (!$this->ParseBody(substr($this->body_buffer, 0, $position), 1, $this->body_offset)) {
                                            return false;
                                        }

                                        if (!$this->QueueBodyParts()) {
                                            return false;
                                        }

                                        $part = [
                                            'Type' => 'EndPart',
                                            'Part' => $this->headers['Boundary'],
                                            'Position' => $this->body_offset + $position,
                                        ];
                                        $this->body_buffer = substr($this->body_buffer, $next);
                                        $this->body_buffer_position = 0;
                                        $this->body_offset += $next;
                                        $this->body_parser_state = MIME_PARSER_BODY_DONE;
                                        break 2;
                                    } elseif (!strcmp($line, $boundary)) {
                                        if (!$this->ParseBody(substr($this->body_buffer, 0, $position), 1, $this->body_offset)) {
                                            return false;
                                        }

                                        if (!$this->QueueBodyParts()) {
                                            return false;
                                        }

                                        $part = [
                                            'Type' => 'EndPart',
                                            'Part' => $this->headers['Boundary'],
                                            'Position' => $this->body_offset + $position,
                                        ];
                                        $this->parts[] = $part;
                                        $part = [
                                            'Type' => 'StartPart',
                                            'Part' => $this->headers['Boundary'],
                                            'Position' => $this->body_offset + $next,
                                        ];
                                        $this->parts[] = $part;
                                        UnSet($this->body_parser);
                                        $this->body_parser = new Mparser();
                                        $this->body_parser->decode_bodies = 1;
                                        $this->body_parser->mbox = 0;
                                        $this->body_buffer = substr($this->body_buffer, $next);
                                        $this->body_buffer_position = 0;
                                        $this->body_offset += $next;
                                        $position = 0;
                                        continue;
                                    }
                                    $position = $next;
                                }
                                break;
                            case MIME_PARSER_BODY_DONE:
                                return true;
                            default:
                                return ($this->SetPositionedError($this->state . ' is not a valid body parser state', $this->body_buffer_position));
                        }
                    } elseif (IsSet($this->headers['QuotedPrintable'])) {
                        for ($end = strlen($this->body_buffer), $decoded = '', $position = $this->body_buffer_position; $position < $end;) {
                            if (!is_int($equal = strpos($this->body_buffer, '=', $position))) {
                                $decoded .= substr($this->body_buffer, $position);
                                $position = $end;
                                break;
                            }
                            $next = $equal + 1;
                            switch ($end - $equal) {
                                case 1:
                                    $decoded .= substr($this->body_buffer, $position, $equal - $position);
                                    $position = $equal;
                                    break 2;
                                case 2:
                                    $decoded .= substr($this->body_buffer, $position, $equal - $position);
                                    if (!strcmp($this->body_buffer[$next], "\n")) {
                                        $position = $end;
                                    } else {
                                        $position = $equal;
                                    }

                                    break 2;
                            }
                            if (!strcmp(substr($this->body_buffer, $next, 2), $break = "\r\n") || !strcmp($this->body_buffer[$next], $break = "\n") || !strcmp($this->body_buffer[$next], $break = "\r")) {
                                $decoded .= substr($this->body_buffer, $position, $equal - $position);
                                $position = $next + strlen($break);
                                continue;
                            }
                            $decoded .= substr($this->body_buffer, $position, $equal - $position);
                            $h = HexDec($hex = strtolower(substr($this->body_buffer, $next, 2)));
                            if (strcmp(sprintf('%02x', $h), $hex)) {
                                if (!$this->SetPositionedWarning('the body specified an invalid quoted-printable encoded character', $this->body_offset + $next)) {
                                    return false;
                                }

                                $decoded .= '=';
                                $position = $next;
                            } else {
                                $decoded .= Chr($h);
                                $position = $equal + 3;
                            }
                        }
                        if (strlen($decoded) == 0) {
                            $this->body_buffer_position = $position;
                            return true;
                        }
                        $part['Data'] = $decoded;
                        $this->body_buffer = substr($this->body_buffer, $position);
                        $this->body_buffer_position = 0;
                        $this->body_offset += $position;
                    } elseif (IsSet($this->headers['Base64'])) {
                        $part['Data'] = base64_decode($this->body_buffer_position ? substr($this->body_buffer, $this->body_buffer_position) : $this->body_buffer);
                        $this->body_offset += strlen($this->body_buffer) - $this->body_buffer_position;
                        $this->body_buffer_position = 0;
                        $this->body_buffer = '';
                    } else {
                        $part['Data'] = substr($this->body_buffer, $this->body_buffer_position);
                        $this->body_buffer_position = 0;
                        $this->body_buffer = '';
                    }
                }
                break;
        }
        $this->parts[] = $part;
        return true;
    }

    private function DecodeStream($parameters, $position, &$end_of_message, &$decoded)
    {
        $this->message_position = $position;
        $end_of_message = 1;
        $state = MIME_MESSAGE_START;
        for (;;) {
            if (!$this->GetPart($part, $end)) {
                return false;
            }

            if ($end) {
                if (IsSet($parameters['File'])) {
                    $end_of_data = feof($this->file);
                    if ($end_of_data) {
                        break;
                    }

                    $data = @fread($this->file, $this->message_buffer_length);
                    if (!is_string($data)) {
                        return ($this->SetPHPError('could not read the message file', $php_errormsg));
                    }

                    $end_of_data = feof($this->file);
                } else {
                    $end_of_data = ($this->position >= strlen($parameters['Data']));
                    if ($end_of_data) {
                        break;
                    }

                    $data = substr($parameters['Data'], $this->position, $this->message_buffer_length);
                    $this->position += strlen($data);
                    $end_of_data = ($this->position >= strlen($parameters['Data']));
                }
                if (!$this->Parse($data, $end_of_data)) {
                    return false;
                }

                continue;
            }
            $type = $part['Type'];
            switch ($state) {
                case MIME_MESSAGE_START:
                    switch ($type) {
                        case 'MessageStart':
                            $decoded = [
                                'Headers' => [],
                                'Parts' => [],
                                'Position' => $this->message_position,
                            ];
                            $end_of_message = 0;
                            $state = MIME_MESSAGE_GET_HEADER_NAME;
                            continue 3;
                        case 'MessageEnd':
                            return ($this->SetPositionedWarning('incorrectly ended body part', $part['Position']));
                    }
                    break;

                case MIME_MESSAGE_GET_HEADER_NAME:
                    switch ($type) {
                        case 'HeaderName':
                            $header = strtolower($part['Name']);
                            $state = MIME_MESSAGE_GET_HEADER_VALUE;
                            continue 3;
                        case 'BodyStart':
                            $state = MIME_MESSAGE_GET_BODY;
                            $part_number = 0;
                            continue 3;
                    }
                    break;

                case MIME_MESSAGE_GET_HEADER_VALUE:
                    switch ($type) {
                        case 'HeaderValue':
                            $value = trim($part['Value']);
                            if (!IsSet($decoded['Headers'][$header])) {
                                $h = 0;
                                $decoded['Headers'][$header] = $value;
                            } elseif (is_string($decoded['Headers'][$header])) {
                                $h = 1;
                                $decoded['Headers'][$header] = [$decoded['Headers'][$header], $value];
                            } else {
                                $h = count($decoded['Headers'][$header]);
                                $decoded['Headers'][$header][] = $value;
                            }
                            if (IsSet($part['Decoded']) && (count($part['Decoded']) > 1 || strcmp($part['Decoded'][0]['Encoding'], 'ASCII') || strcmp($value, trim($part['Decoded'][0]['Value'])))) {
                                $p = $part['Decoded'];
                                $p[0]['Value'] = ltrim($p[0]['Value']);
                                $last = count($p) - 1;
                                $p[$last]['Value'] = rtrim($p[$last]['Value']);
                                $decoded['DecodedHeaders'][$header][$h] = $p;
                            }
                            switch ($header) {
                                case 'content-disposition:':
                                    $filename = 'filename';
                                    break;
                                case 'content-type:':
                                    if (!IsSet($decoded['FileName'])) {
                                        $filename = 'name';
                                        break;
                                    }
                                default:
                                    $filename = '';
                                    break;
                            }
                            if (strlen($filename)) {
                                if (IsSet($decoded['DecodedHeaders'][$header][$h]) && count($decoded['DecodedHeaders'][$header][$h]) == 1) {
                                    $value = $decoded['DecodedHeaders'][$header][$h][0]['Value'];
                                    $encoding = $decoded['DecodedHeaders'][$header][$h][0]['Encoding'];
                                } else {
                                    $encoding = '';
                                }

                                $this->ParseStructuredHeader($value, $type, $header_parameters, $character_sets, $languages);
                                if (IsSet($header_parameters[$filename])) {
                                    $decoded['FileName'] = $header_parameters[$filename];
                                    if (IsSet($character_sets[$filename]) && strlen($character_sets[$filename])) {
                                        $decoded['FileNameCharacterSet'] = $character_sets[$filename];
                                    }

                                    if (IsSet($character_sets['language']) && strlen($character_sets['language'])) {
                                        $decoded['FileNameCharacterSet'] = $character_sets[$filename];
                                    }

                                    if (!IsSet($decoded['FileNameCharacterSet']) && strlen($encoding)) {
                                        $decoded['FileNameCharacterSet'] = $encoding;
                                    }

                                    if (!strcmp($header, 'content-disposition:')) {
                                        $decoded['FileDisposition'] = $type;
                                    }
                                }
                            }
                            $state = MIME_MESSAGE_GET_HEADER_NAME;
                            continue 3;
                    }
                    break;

                case MIME_MESSAGE_GET_BODY:
                    switch ($type) {
                        case 'BodyData':
                            if (IsSet($parameters['SaveBody'])) {
                                if (!IsSet($decoded['BodyFile'])) {
                                    $directory_separator = (defined('DIRECTORY_SEPARATOR') ? DIRECTORY_SEPARATOR : '/');
                                    $path = (strlen($parameters['SaveBody']) ? ($parameters['SaveBody'] . (strcmp($parameters['SaveBody'][strlen($parameters['SaveBody']) - 1], $directory_separator) ? $directory_separator : '')) : '');
                                    $filename = strval($this->body_part_number);
                                    if ($this->use_part_file_names && !$this->GetPartFileName($decoded, $filename)) {
                                        return false;
                                    }

                                    if (file_exists($path . $filename)) {
                                        if (is_int($dot = strrpos($filename, '.'))) {
                                            $base = substr($filename, 0, $dot);
                                            $extension = substr($filename, $dot);
                                        } else {
                                            $base = $filename;
                                            $extension = '';
                                        }
                                        $appendix = 0;
                                        do {
                                            ++$appendix;
                                            $filename = $base . $appendix . $extension;
                                        } while (file_exists($path . $filename));
                                    }
                                    $path .= $filename;
                                    if (!($this->body_file = fopen($path, 'wb'))) {
                                        return ($this->SetPHPError('could not create file ' . $path . ' to save the message body part', $php_errormsg));
                                    }

                                    $decoded['BodyFile'] = $path;
                                    $decoded['BodyPart'] = $this->body_part_number;
                                    $decoded['BodyLength'] = 0;
                                    $this->body_part_number++;
                                }
                                if (strlen($part['Data']) && !fwrite($this->body_file, $part['Data'])) {
                                    $this->SetPHPError('could not save the message body part to file ' . $decoded['BodyFile'], $php_errormsg);
                                    fclose($this->body_file);
                                    @unlink($decoded['BodyFile']);
                                    return false;
                                }
                            } elseif (IsSet($parameters['SkipBody']) && $parameters['SkipBody']) {
                                if (!IsSet($decoded['BodyPart'])) {
                                    $decoded['BodyPart'] = $this->body_part_number;
                                    $decoded['BodyLength'] = 0;
                                    $this->body_part_number++;
                                }
                            } else {
                                if (IsSet($decoded['Body'])) {
                                    $decoded['Body'] .= $part['Data'];
                                } else {
                                    $decoded['Body'] = $part['Data'];
                                    $decoded['BodyPart'] = $this->body_part_number;
                                    $decoded['BodyLength'] = 0;
                                    $this->body_part_number++;
                                }
                            }
                            $decoded['BodyLength'] += strlen($part['Data']);
                            continue 3;
                        case 'StartPart':
                            if (!$this->DecodeStream($parameters, $position + $part['Position'], $end_of_part, $decoded_part)) {
                                return false;
                            }

                            $decoded['Parts'][$part_number] = $decoded_part;
                            $part_number++;
                            $state = MIME_MESSAGE_GET_BODY_PART;
                            continue 3;
                        case 'MessageEnd':
                            if (IsSet($decoded['BodyFile'])) {
                                fclose($this->body_file);
                            }

                            return true;
                    }
                    break;

                case MIME_MESSAGE_GET_BODY_PART:
                    switch ($type) {
                        case 'EndPart':
                            $state = MIME_MESSAGE_GET_BODY;
                            continue 3;
                    }
                    break;
            }
            return ($this->SetError('unexpected decoded message part type ' . $type . ' in state ' . $state));
        }
        return true;
    }

    /* Public functions */

    public function GetPartFileName($decoded, &$filename)
    {
        if (IsSet($decoded['FileName'])) {
            $filename = basename($decoded['FileName']);
        }

        return true;
    }

    public function Parse($data, $end)
    {
        if (strlen($this->error)) {
            return false;
        }

        if ($this->state == MIME_PARSER_END) {
            return ($this->SetError('the parser already reached the end'));
        }

        $length = strlen($data);
        if ($this->track_lines && $length) {
            $line = $this->last_line;
            $position = 0;
            if ($this->last_carriage_return) {
                if ($data[0] == "\n") {
                    ++$position;
                }

                $this->lines[++$line] = $this->line_offset + $position;
                $this->last_carriage_return = 0;
            }
            while ($position < $length) {
                $position += strcspn($data, "\r\n", $position);
                if ($position >= $length) {
                    break;
                }

                if ($data[$position] == "\r") {
                    ++$position;
                    if ($position >= $length) {
                        $this->last_carriage_return = 1;
                        break;
                    }
                    if ($data[$position] == "\n") {
                        ++$position;
                    }

                    $this->lines[++$line] = $this->line_offset + $position;
                } else {
                    ++$position;
                    $this->lines[++$line] = $this->line_offset + $position;
                }
            }
            $this->last_line = $line;
            $this->line_offset += $length;
        }
        $this->buffer .= $data;
        do {
            Unset($part);
            if (!$this->ParsePart($end, $part, $need_more_data)) {
                return false;
            }

            if (IsSet($part) && !$this->DecodePart($part)) {
                return false;
            }
        } while (!$need_more_data && $this->state != MIME_PARSER_END);
        if ($end && $this->state != MIME_PARSER_END) {
            return ($this->SetError('reached a premature end of data'));
        }

        if ($this->buffer_position > 0) {
            $this->offset += $this->buffer_position;
            $this->buffer = substr($this->buffer, $this->buffer_position);
            $this->buffer_position = 0;
        }
        return true;
    }

    public function ParseFile($file)
    {
        if (strlen($this->error)) {
            return false;
        }

        if (!($stream = @fopen($file, 'r'))) {
            return ($this->SetPHPError('Could not open the file ' . $file, $php_errormsg));
        }

        for ($end = 0; !$end;) {
            if (!($data = @fread($stream, $this->message_buffer_length))) {
                $this->SetPHPError('Could not read the file ' . $file, $php_errormsg);
                fclose($stream);
                return false;
            }
            $end = feof($stream);
            if (!$this->Parse($data, $end)) {
                fclose($stream);
                return false;
            }
        }
        fclose($stream);
        return true;
    }

    public function GetPart(&$part, &$end)
    {
        $end = ($this->part_position >= count($this->parts));
        if ($end) {
            if ($this->part_position) {
                $this->part_position = 0;
                $this->parts = [];
            }
        } else {
            $part = $this->parts[$this->part_position];
            $this->part_position++;
        }
        return true;
    }

    public function Decode($parameters, &$decoded)
    {
        if (IsSet($parameters['File'])) {
            if (!($this->file = @fopen($parameters['File'], 'r'))) {
                return ($this->SetPHPError('could not open the message file to decode ' . $parameters['File'], $php_errormsg));
            }
        } elseif (IsSet($parameters['Data'])) {
            $this->position = 0;
        } else {
            return ($this->SetError('it was not specified a valid message to decode'));
        }

        $this->warnings = $decoded = [];
        $this->ResetParserState();
        for ($message = 0; ($success = $this->DecodeStream($parameters, 0, $end_of_message, $decoded_message)) && !$end_of_message; $message++) {
            $decoded[$message] = $decoded_message;
        }
        if (IsSet($parameters['File'])) {
            fclose($this->file);
        }

        return ($success);
    }

    public function ReadMessageBody($message, &$body, $prefix)
    {
        if (IsSet($message[$prefix])) {
            $body = $message[$prefix];
        } elseif (IsSet($message[$prefix . 'File'])) {
            $path = $message[$prefix . 'File'];
            if (!($file = @fopen($path, 'rb'))) {
                return ($this->SetPHPError('could not open the message body file ' . $path, $php_errormsg));
            }

            for ($body = '', $end = 0; !$end;) {
                if (!($data = @fread($file, $this->message_buffer_length))) {
                    $this->SetPHPError('Could not open the message body file ' . $path, $php_errormsg);
                    //fclose($stream);
                    return false;
                }
                $end = feof($file);
                $body .= $data;
            }
            fclose($file);
        } else {
            $body = '';
        }

        return true;
    }

    public function Analyze($message, &$results)
    {
        $results = [];
        if (!IsSet($message['Headers']['content-type:'])) {
            $content_type = 'text/plain';
        } elseif (count($message['Headers']['content-type:']) == 1) {
            $content_type = $message['Headers']['content-type:'];
        } else {
            if (!$this->SetPositionedWarning('message contains multiple content-type headers', $message['Position'])) {
                return false;
            }

            $content_type = $message['Headers']['content-type:'][0];
        }
        $disposition = $this->ParseParameters($content_type, $content_type, $parameters, 'disposition');
        $type = $this->Tokenize($content_type, '/');
        $sub_type = $this->Tokenize(';');
        $copy_body = 1;
        $tolerate_unrecognized = 1;
        switch ($type) {
            case 'multipart':
                $tolerate_unrecognized = 0;
                $copy_body = 0;
                $lp = count($message['Parts']);
                if ($lp == 0) {
                    return ($this->SetError($this->decode_bodies ? 'No parts were found in the ' . $content_type . ' part message' : 'It is not possible to analyze multipart messages without parsing the contained message parts. Please set the decode_bodies variable to 1 before parsing the message'));
                }

                $parts = [];
                for ($p = 0; $p < $lp; ++$p) {
                    if (!$this->Analyze($message['Parts'][$p], $parts[$p])) {
                        return false;
                    }
                }
                switch ($sub_type) {
                    case 'alternative':
                        $p = $lp;
                        $results = $parts[--$p];
                        for (--$p; $p >= 0; --$p) {
                            $results['Alternative'][] = $parts[$p];
                        }

                        break;

                    case 'related':
                        $results = $parts[0];
                        for ($p = 1; $p < $lp; ++$p) {
                            $results['Related'][] = $parts[$p];
                        }

                        break;

                    case 'mixed':
                        $results = $parts[0];
                        for ($p = 1; $p < $lp; ++$p) {
                            $results['Attachments'][] = $parts[$p];
                        }

                        break;

                    case 'report':
                        if (IsSet($parameters['report-type'])) {
                            switch ($parameters['report-type']) {
                                case 'delivery-status':
                                    for ($p = 1; $p < $lp; ++$p) {
                                        if (!strcmp($parts[$p]['Type'], $parameters['report-type'])) {
                                            $results = $parts[$p];
                                            break;
                                        }
                                    }
                                    if (!$this->ReadMessageBody($parts[0], $body, 'Data')) {
                                        return false;
                                    }

                                    if (strlen($body)) {
                                        $results['Response'] = $body;
                                    }

                                    break;
                                default:
                                    $this->SetError('the report type is ' . $parameters['report-type'] . ' is not yet supported');
                                    $results['Response'] = $this->error;
                                    $this->error = '';
                                    break;
                            }
                            $results['Type'] = $parameters['report-type'];
                        } else {
                            return ($this->SetError('this ' . $content_type . ' message is not well formed because it does not define the report type'));
                        }

                        break;

                    case 'signed':
                        if ($lp != 2) {
                            return ($this->SetError('this ' . $content_type . ' message does not have just 2 parts'));
                        }

                        if (strcmp($parts[1]['Type'], 'signature')) {
                            $this->SetError('this ' . $content_type . ' message does not contain a signature');
                            $this->error = '';
                        }
                        $results = $parts[0];
                        $results['Signature'] = $parts[1];
                        break;

                    case 'appledouble':
                        if ($lp != 2) {
                            return ($this->SetError('this ' . $content_type . ' message does not have just 2 parts'));
                        }

                        if (strcmp($parts[0]['Type'], 'applefile')) {
                            $this->SetError('this ' . $content_type . ' message does not contain an Apple file header');
                            $this->error = '';
                        }
                        $results = $parts[1];
                        $results['AppleFileHeader'] = $parts[0];
                        break;

                    case 'form-data':
                        $results['Type'] = 'form-data';
                        $results['FormData'] = [];
                        for ($p = 0; $p < $lp; ++$p) {
                            if (!IsSet($message['Parts'][$p]['Headers']['content-disposition:'])) {
                                return ($this->SetError('the form data part ' . $p . ' is missing the content-disposition header'));
                            }

                            $disposition = $message['Parts'][$p]['Headers']['content-disposition:'];
                            $name = $this->ParseParameters($disposition, $disposition, $parameters, 'name');
                            if (strcmp($disposition, 'form-data')) {
                                if (!$this->SetPositionedWarning('disposition of part ' . $p . ' is not form-data', $message['Parts'][$p]['Position'])) {
                                    return false;
                                }

                                continue;
                            }
                            $results['FormData'][$name] = $parts[$p];
                        }
                        break;
                }
                break;
            case 'text':
                switch ($sub_type) {
                    case 'plain':
                        $results['Type'] = 'text';
                        $results['Description'] = 'Text message';
                        break;
                    case 'html':
                        $results['Type'] = 'html';
                        $results['Description'] = 'HTML message';
                        break;
                    case 'rtf':
                        $results['Type'] = 'rtf';
                        $results['Description'] = 'Document in Rich Text Format';
                        break;
                    default:
                        $results['Type'] = $type;
                        $results['SubType'] = $sub_type;
                        $results['Description'] = 'Text file in the ' . strtoupper($sub_type) . ' format';
                        break;
                }
                break;
            case 'video':
                $results['Type'] = $type;
                $results['SubType'] = $sub_type;
                $results['Description'] = 'Video file in the ' . strtoupper($sub_type) . ' format';
                break;
            case 'image':
                $results['Type'] = $type;
                $results['SubType'] = $sub_type;
                $results['Description'] = 'Image file in the ' . strtoupper($sub_type) . ' format';
                break;
            case 'audio':
                $results['Type'] = $type;
                $results['SubType'] = $sub_type;
                $results['Description'] = 'Audio file in the ' . strtoupper($sub_type) . ' format';
                break;
            case 'application':
                switch ($sub_type) {
                    case 'octet-stream':
                    case 'x-msdownload':
                        $results['Type'] = 'binary';
                        $results['Description'] = 'Binary file';
                        break;
                    case 'pdf':
                        $results['Type'] = $sub_type;
                        $results['Description'] = 'Document in PDF format';
                        break;
                    case 'postscript':
                        $results['Type'] = $sub_type;
                        $results['Description'] = 'Document in Postscript format';
                        break;
                    case 'msword':
                        $results['Type'] = 'ms-word';
                        $results['Description'] = 'Word processing document in Microsoft Word format';
                        break;
                    case 'vnd.ms-powerpoint':
                        $results['Type'] = 'ms-powerpoint';
                        $results['Description'] = 'Presentation in Microsoft PowerPoint format';
                        break;
                    case 'vnd.ms-excel':
                        $results['Type'] = 'ms-excel';
                        $results['Description'] = 'Spreadsheet in Microsoft Excel format';
                        break;
                    case 'x-compressed':
                        if (!IsSet($parameters['name']) || !is_int($dot = strpos($parameters['name'], '.')) || strcmp($extension = strtolower(substr($parameters['name'], $dot + 1)), 'zip')) {
                            break;
                        }

                    case 'zip':
                    case 'x-zip':
                    case 'x-zip-compressed':
                        $results['Type'] = 'zip';
                        $results['Description'] = 'ZIP archive with compressed files';
                        break;
                    case 'ms-tnef':
                        $results['Type'] = $sub_type;
                        $results['Description'] = 'Microsoft Exchange data usually sent by Microsoft Outlook';
                        break;
                    case 'pgp-signature':
                        $results['Type'] = 'signature';
                        $results['SubType'] = $sub_type;
                        $results['Description'] = 'Message signature for PGP';
                        break;
                    case 'x-pkcs7-signature':
                    case 'pkcs7-signature':
                        $results['Type'] = 'signature';
                        $results['SubType'] = $sub_type;
                        $results['Description'] = 'PKCS message signature';
                        break;
                    case 'vnd.oasis.opendocument.text':
                        $results['Type'] = 'odf-writer';
                        $results['Description'] = 'Word processing document in ODF text format used by OpenOffice Writer';
                        break;
                    case 'applefile':
                        $results['Type'] = 'applefile';
                        $results['Description'] = 'Apple file resource header';
                        break;
                    case 'rtf':
                        $results['Type'] = $sub_type;
                        $results['Description'] = 'Document in Rich Text Format';
                        break;
                    case 'x-httpd-php':
                        $results['Type'] = 'php';
                        $results['Description'] = 'PHP script';
                        break;
                }
                break;
            case 'message':
                $tolerate_unrecognized = 0;
                switch ($sub_type) {
                    case 'delivery-status':
                        $results['Type'] = $sub_type;
                        $results['Description'] = 'Notification of the status of delivery of a message';
                        if (!$this->ReadMessageBody($message, $body, 'Body')) {
                            return false;
                        }

                        if (($l = strlen($body))) {
                            $position = 0;
                            $this->ParseHeaderString($body, $position, $headers);
                            $recipients = [];
                            for (; $position < $l;) {
                                $this->ParseHeaderString($body, $position, $headers);
                                if (count($headers)) {
                                    $r = count($recipients);
                                    if (IsSet($headers['action'])) {
                                        $recipients[$r]['Action'] = $headers['action'];
                                    }

                                    if (IsSet($headers['status'])) {
                                        $recipients[$r]['Status'] = $headers['status'];
                                    }

                                    if (IsSet($headers['original-recipient'])) {
                                        strtok($headers['original-recipient'], ';');
                                        $recipients[$r]['Address'] = trim(strtok(''));
                                    } elseif (IsSet($headers['final-recipient'])) {
                                        strtok($headers['final-recipient'], ';');
                                        $recipients[$r]['Address'] = trim(strtok(''));
                                    }
                                }
                            }
                            $results['Recipients'] = $recipients;
                        }
                        $copy_body = 0;
                        break;
                    case 'rfc822':
                        $results['Type'] = 'message';
                        $results['Description'] = 'E-mail message';
                        break;
                }
                break;
            default:
                $tolerate_unrecognized = 0;
                break;
        }
        /* Use normal */
        $results['Type'] = $type;
        $results['SubType'] = $sub_type;
        if (!IsSet($results['Type'])) {
            if (IsSet($this->custom_mime_types[$content_type])) {
                $results['Type'] = $this->custom_mime_types[$content_type]['Type'];
                $results['Description'] = $this->custom_mime_types[$content_type]['Description'];
            } else {
                $this->SetError($content_type . ' message parts are not yet recognized. You can define these part type names and descriptions setting the custom_mime_types class variable');
                $results['Type'] = $this->error;
                $this->error = '';
            }
        }
        if (IsSet($parameters['charset'])) {
            $results['Encoding'] = strtolower($parameters['charset']);
        }

        if ($copy_body) {
            if (IsSet($message['BodyFile'])) {
                $results['DataFile'] = $message['BodyFile'];
            }

            if (IsSet($message['BodyLength'])) {
                $results['DataLength'] = $message['BodyLength'];
            }

            if (IsSet($message['FileName'])) {
                $results['FileName'] = $message['FileName'];
            }

            if (IsSet($message['FileDisposition'])) {
                $results['FileDisposition'] = $message['FileDisposition'];
            }

            if (IsSet($message['Headers']['content-id:'])) {
                $content_id = trim($message['Headers']['content-id:']);
                $l = strlen($content_id);
                if (!strcmp($content_id[0], '<') && !strcmp($content_id[$l - 1], '>')) {
                    $results['ContentID'] = substr($content_id, 1, $l - 2);
                }
            }
        }
        return true;
    }

}
