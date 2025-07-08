<?php
/**
 * SQL Injection Payload Mutator Utility
 * For educational purposes only.
 */

// Remove all numbers from the payload.
function remove_numbers($payload) {
    return preg_replace('/\d/', '', $payload);
}

// Remove all spaces from the payload.
function remove_spaces($payload) {
    return str_replace(' ', '', $payload);
}

// Replace spaces with SQL comments (/**/).
function space_to_comment($payload) {
    return str_replace(' ', '/**/', $payload);
}

// Replace spaces with tabs.
function space_to_tab($payload) {
    return str_replace(' ', "\t", $payload);
}

// Replace spaces with newlines.
function space_to_newline($payload) {
    return str_replace(' ', "\n", $payload);
}

// Randomize case in SQL keywords.
function randomize_case($payload) {
    $output = '';
    for ($i = 0; $i < strlen($payload); $i++) {
        if (ctype_alpha($payload[$i])) {
            $output .= rand(0, 1) ? strtoupper($payload[$i]) : strtolower($payload[$i]);
        } else {
            $output .= $payload[$i];
        }
    }
    return $output;
}

// Inline obfuscation with comments inside keywords (e.g., UN/**/ION).
function inline_comment_keywords($payload) {
    $keywords = ['UNION', 'SELECT', 'WHERE', 'FROM', 'AND', 'OR', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'ORDER', 'BY', 'GROUP', 'HAVING'];
    foreach ($keywords as $k) {
        $payload = preg_replace_callback("/$k/i", function ($matches) {
            $kw = $matches[0];
            if (strlen($kw) > 2) {
                $mid = floor(strlen($kw)/2);
                return substr($kw,0,$mid) . "/**/" . substr($kw,$mid);
            }
            return $kw;
        }, $payload);
    }
    return $payload;
}

// URL-encode the payload.
function url_encode_payload($payload) {
    return urlencode($payload);
}

// Hex encode the payload (MySQL: 0x...).
function hex_encode_payload($payload) {
    $hex = '0x' . bin2hex($payload);
    return $hex;
}

// Use CHAR() concatenation for payload (MySQL only).
function char_concat_payload($payload) {
    $chars = array_map(function($c) { return 'CHAR(' . ord($c) . ')'; }, str_split($payload));
    return implode(',', $chars);
}

// Append SQL comment to the payload to ignore the rest of the query.
function append_comment($payload) {
    return $payload . " -- ";
}

// Combine techniques: spaces to comments, randomize case, append comment.
function advanced_mutation($payload) {
    $payload = space_to_comment($payload);
    $payload = randomize_case($payload);
    return append_comment($payload);
}

// Select mutation by name
function mutate_payload($payload, $mutation) {
    switch ($mutation) {
        case 'remove_numbers': return remove_numbers($payload);
        case 'remove_spaces': return remove_spaces($payload);
        case 'space_to_comment': return space_to_comment($payload);
        case 'space_to_tab': return space_to_tab($payload);
        case 'space_to_newline': return space_to_newline($payload);
        case 'randomize_case': return randomize_case($payload);
        case 'inline_comment_keywords': return inline_comment_keywords($payload);
        case 'url_encode': return url_encode_payload($payload);
        case 'hex_encode': return hex_encode_payload($payload);
        case 'char_concat': return char_concat_payload($payload);
        case 'append_comment': return append_comment($payload);
        case 'advanced_mutation': return advanced_mutation($payload);
        default: return $payload;
    }
}

// Example usage UI
if (isset($_GET['payload'])) {
    $payload = $_GET['payload'];
    $mutation = isset($_GET['mutation']) ? $_GET['mutation'] : '';
    $mutated = mutate_payload($payload, $mutation);
    echo "<b>Original:</b> " . htmlspecialchars($payload) . "<br>";
    echo "<b>Mutation:</b> " . htmlspecialchars($mutation) . "<br>";
    echo "<b>Mutated payload:</b> <pre>" . htmlspecialchars($mutated) . "</pre><br>";
    echo "<hr><b>All mutations:</b><ul>";
    foreach (['remove_numbers','remove_spaces','space_to_comment','space_to_tab','space_to_newline','randomize_case','inline_comment_keywords','url_encode','hex_encode','char_concat','append_comment','advanced_mutation'] as $m) {
        echo "<li><b>$m:</b> <pre>" . htmlspecialchars(mutate_payload($payload, $m)) . "</pre></li>";
    }
    echo "</ul>";
}
?>
