# Servidor HTTP simples em PowerShell
$port = 8000
$url = "http://localhost:$port/"

Add-Type -AssemblyName System.Web

$listener = New-Object System.Net.HttpListener
$listener.Prefixes.Add($url)
$listener.Start()

Write-Host "Servidor rodando em $url" -ForegroundColor Green
Write-Host "Pressione Ctrl+C para parar" -ForegroundColor Yellow

try {
    while ($listener.IsListening) {
        $context = $listener.GetContext()
        $request = $context.Request
        $response = $context.Response
        
        $localPath = $request.Url.LocalPath
        if ($localPath -eq '/') {
            $localPath = '/index.html'
        }
        
        $filePath = Join-Path (Get-Location) $localPath.TrimStart('/')
        
        if (Test-Path $filePath) {
            $content = [System.IO.File]::ReadAllBytes($filePath)
            $ext = [System.IO.Path]::GetExtension($filePath).ToLower()
            
            switch ($ext) {
                '.html' { $response.ContentType = 'text/html; charset=utf-8' }
                '.css' { $response.ContentType = 'text/css' }
                '.js' { $response.ContentType = 'application/javascript' }
                '.svg' { $response.ContentType = 'image/svg+xml' }
                '.ico' { $response.ContentType = 'image/x-icon' }
                '.png' { $response.ContentType = 'image/png' }
                '.jpg' { $response.ContentType = 'image/jpeg' }
                '.jpeg' { $response.ContentType = 'image/jpeg' }
                default { $response.ContentType = 'application/octet-stream' }
            }
            
            $response.ContentLength64 = $content.Length
            $response.OutputStream.Write($content, 0, $content.Length)
            
            Write-Host "$($request.HttpMethod) $($request.Url.LocalPath) - 200 OK" -ForegroundColor Green
        } else {
            $response.StatusCode = 404
            $errorContent = [System.Text.Encoding]::UTF8.GetBytes('404 - Arquivo não encontrado')
            $response.ContentType = 'text/plain; charset=utf-8'
            $response.OutputStream.Write($errorContent, 0, $errorContent.Length)
            
            Write-Host "$($request.HttpMethod) $($request.Url.LocalPath) - 404 Not Found" -ForegroundColor Red
        }
        
        $response.Close()
    }
} finally {
    $listener.Stop()
    Write-Host "Servidor parado" -ForegroundColor Yellow
}