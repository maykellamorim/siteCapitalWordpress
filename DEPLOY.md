# Deploy no Vercel - CAPITAL Agro Investors

## Pré-requisitos

1. Conta no [Vercel](https://vercel.com)
2. Repositório Git (GitHub, GitLab ou Bitbucket)
3. Node.js instalado localmente

## Configurações Implementadas

### ✅ Arquivos de Configuração

- **`vercel.json`**: Configurado com:
  - Build command: `npm run build`
  - Output directory: `dist`
  - Headers de segurança
  - Rewrites para SPA
  - Cache otimizado

- **`.vercelignore`**: Exclui arquivos desnecessários do deploy

- **`package.json`**: Scripts de build configurados

### 🚀 Como Fazer o Deploy

#### Opção 1: Deploy via Git (Recomendado)

1. **Conecte seu repositório ao Vercel:**
   ```bash
   # Se ainda não fez, inicialize o git
   git init
   git add .
   git commit -m "Initial commit"
   
   # Conecte ao seu repositório remoto
   git remote add origin https://github.com/seu-usuario/seu-repositorio.git
   git push -u origin main
   ```

2. **No painel do Vercel:**
   - Acesse [vercel.com](https://vercel.com)
   - Clique em "New Project"
   - Importe seu repositório
   - As configurações serão detectadas automaticamente
   - Clique em "Deploy"

#### Opção 2: Deploy via CLI

1. **Instale a CLI do Vercel:**
   ```bash
   npm i -g vercel
   ```

2. **Faça login:**
   ```bash
   vercel login
   ```

3. **Deploy:**
   ```bash
   vercel --prod
   ```

### 🔧 Configurações Automáticas

O Vercel detectará automaticamente:
- Framework: Static Site
- Build Command: `npm run build`
- Output Directory: `dist`
- Install Command: `npm install`

### 🛡️ Recursos de Segurança Incluídos

- Headers de segurança (XSS Protection, Frame Options, etc.)
- HTTPS automático
- Cache otimizado para assets estáticos
- Compressão Gzip/Brotli

### 📊 Performance

- Service Worker para cache offline
- Lazy loading de imagens
- Minificação de CSS/JS
- Otimização de imagens

### ⚠️ Avisos do Build

O build atual mostra avisos sobre o tamanho de algumas imagens:
- `campo.jpg` (1.07 MB)
- `laboratorio.jpg` (1.73 MB)

**Recomendação:** Otimize essas imagens para melhor performance:
```bash
# Exemplo usando imagemin ou similar
npm install -g imagemin-cli imagemin-mozjpeg
imagemin assets/img/*.jpg --out-dir=assets/img --plugin=mozjpeg
```

### 🔄 Deploy Contínuo

Após conectar o repositório, o Vercel fará deploy automaticamente a cada push para a branch principal.

### 🌐 Domínio Personalizado

Para usar o domínio `capitalagro.com.br`:
1. No painel do Vercel, vá em "Domains"
2. Adicione seu domínio personalizado
3. Configure os DNS conforme instruções do Vercel

### 📝 Variáveis de Ambiente

Se precisar de variáveis de ambiente:
1. No painel do Vercel, vá em "Settings" > "Environment Variables"
2. Adicione as variáveis necessárias
3. Redeploy o projeto

---

**Status:** ✅ Pronto para deploy no Vercel
**Última atualização:** $(Get-Date -Format "dd/MM/yyyy HH:mm")