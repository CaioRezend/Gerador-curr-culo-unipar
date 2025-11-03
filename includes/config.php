<?php
/**
 * Carrega as configurações de um arquivo JSON.
 * @param string $file_path O caminho para o arquivo JSON.
 * @return array|null As configurações como um array associativo ou null se falhar.
 */
function loadConfig(string $file_path): ?array {
    if (!file_exists($file_path)) {
        error_log("Arquivo de configuração não encontrado: " . $file_path);
        return null;
    }
    $json_content = file_get_contents($file_path);
    $config = json_decode($json_content, true); 

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Erro ao decodificar JSON: " . json_last_error_msg());
        return null;
    }

    return $config;
}
$CONFIG = loadConfig(__DIR__ . '/../config.json');
define('CONFIG_LOADED', $CONFIG !== null);
if ($CONFIG === null) {
    $CONFIG = [];
}