<?php
// Script para capturar o HTML do site e salvar em arquivo
$url = 'http://localhost/capital-agro/';
$html = file_get_contents($url);

if ($html !== false) {
    file_put_contents('site-content.html', $html);
    echo "HTML salvo em site-content.html\n";
    echo "Tamanho do conteúdo: " . strlen($html) . " bytes\n";
    
    // Verificar se há conteúdo nas seções principais
    if (strpos($html, 'hero-section') !== false) {
        echo "✓ Seção hero encontrada\n";
    } else {
        echo "✗ Seção hero NÃO encontrada\n";
    }
    
    if (strpos($html, 'sobre-section') !== false) {
        echo "✓ Seção sobre encontrada\n";
    } else {
        echo "✗ Seção sobre NÃO encontrada\n";
    }
    
    if (strpos($html, 'culturas-section') !== false) {
        echo "✓ Seção culturas encontrada\n";
    } else {
        echo "✗ Seção culturas NÃO encontrada\n";
    }
    
    // Verificar se os CSS estão carregando
    if (strpos($html, 'bootstrap') !== false) {
        echo "✓ Bootstrap encontrado\n";
    } else {
        echo "✗ Bootstrap NÃO encontrado\n";
    }
    
    if (strpos($html, 'style.css') !== false) {
        echo "✓ CSS do tema encontrado\n";
    } else {
        echo "✗ CSS do tema NÃO encontrado\n";
    }
    
} else {
    echo "Erro ao acessar o site\n";
}
?>