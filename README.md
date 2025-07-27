# Capital Agro Investors - WordPress Site

Este projeto foi convertido de um site estático para WordPress, mantendo todo o design e funcionalidades originais.

## 📋 Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior (ou MariaDB 10.3+)
- Servidor web (Apache ou Nginx)
- WordPress 6.0 ou superior

## 🚀 Instalação

### 1. Configuração do Banco de Dados

1. Crie um banco de dados MySQL:
```sql
CREATE DATABASE capital_agro_wp;
CREATE USER 'capital_user'@'localhost' IDENTIFIED BY 'sua_senha_segura';
GRANT ALL PRIVILEGES ON capital_agro_wp.* TO 'capital_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2. Configuração do WordPress

1. Edite o arquivo `wp-config.php` e configure suas credenciais de banco de dados:
```php
define('DB_NAME', 'capital_agro_wp');
define('DB_USER', 'capital_user');
define('DB_PASSWORD', 'sua_senha_segura');
define('DB_HOST', 'localhost');
```

2. Gere novas chaves de segurança em: https://api.wordpress.org/secret-key/1.1/salt/
   E substitua as chaves no `wp-config.php`

### 3. Download do WordPress Core

1. Baixe a versão mais recente do WordPress de: https://wordpress.org/download/
2. Extraia os arquivos do WordPress na raiz do projeto (exceto wp-content que já está configurado)
3. Mantenha a estrutura de pastas existente

### 4. Instalação via Web

1. Acesse seu domínio no navegador
2. Siga o assistente de instalação do WordPress
3. Configure:
   - Título do site: "Capital Agro Investors"
   - Nome de usuário: (escolha um nome seguro)
   - Senha: (use uma senha forte)
   - Email: seu email administrativo

### 5. Ativação do Tema

1. Acesse o painel administrativo (`/wp-admin`)
2. Vá em **Aparência > Temas**
3. Ative o tema "Capital Agro"

## ⚙️ Configuração do Tema

### Menus

1. Vá em **Aparência > Menus**
2. Crie um novo menu chamado "Menu Principal"
3. Adicione os itens:
   - Home
   - Sobre
   - Culturas
   - Segmentos
   - Soluções
   - Parceiros
   - Trabalhe Conosco
   - Contato
4. Atribua ao local "Menu Principal"

### Widgets

1. Vá em **Aparência > Widgets**
2. Configure as áreas de widget do rodapé conforme necessário

### Customizações

1. Vá em **Aparência > Personalizar**
2. Configure:
   - Logo do site
   - Cores (se necessário)
   - Informações de contato

### Tipos de Post Personalizados

O tema inclui os seguintes tipos de post:

#### Culturas
- Campos: Título, Descrição, Imagem, Ícone
- Use para cadastrar as culturas atendidas

#### Soluções
- Campos: Título, Descrição, Imagem
- Use para cadastrar as soluções oferecidas

#### Parceiros
- Campos: Nome, Logo, Link (opcional)
- Use para cadastrar os parceiros da empresa

### Configurações da Empresa

1. Vá em **Configurações > Capital Agro**
2. Configure:
   - Telefone
   - Email
   - Endereço
   - Redes sociais

## 📱 Funcionalidades

- ✅ Design responsivo
- ✅ SEO otimizado
- ✅ Formulários de contato
- ✅ Newsletter
- ✅ Integração com WhatsApp
- ✅ Animações AOS
- ✅ Bootstrap 5
- ✅ Font Awesome
- ✅ Tipos de post personalizados
- ✅ Campos personalizados
- ✅ Áreas de widget
- ✅ Menus personalizados

## 🔧 Desenvolvimento

### Estrutura do Tema

```
wp-content/themes/capital-agro/
├── style.css          # Estilos principais
├── functions.php      # Funcionalidades do tema
├── index.php          # Template principal
├── header.php         # Cabeçalho
├── footer.php         # Rodapé
└── assets/           # Recursos estáticos
    ├── css/
    ├── js/
    └── img/
```

### Hooks Disponíveis

- `capital_agro_after_hero` - Após a seção hero
- `capital_agro_before_footer` - Antes do rodapé
- `capital_agro_custom_fields` - Para adicionar campos personalizados

## 🛡️ Segurança

- Configurações de segurança no `.htaccess`
- Proteção de arquivos sensíveis
- Headers de segurança configurados
- Validação e sanitização de dados

## 📈 Performance

- Cache de navegador configurado
- Compressão GZIP ativada
- Otimização de imagens
- Minificação de CSS/JS (via plugins recomendados)

## 🔌 Plugins Recomendados

- **Yoast SEO** - Otimização para motores de busca
- **Contact Form 7** - Formulários de contato
- **WP Rocket** - Cache e performance
- **Wordfence** - Segurança
- **UpdraftPlus** - Backup
- **Advanced Custom Fields** - Campos personalizados adicionais

## 📞 Suporte

Para suporte técnico ou dúvidas sobre o tema, entre em contato com a equipe de desenvolvimento.

## 📝 Personalização

### Cores

As cores principais do site podem ser facilmente alteradas no arquivo `assets/css/style.css` através das variáveis CSS:

```css
:root {
    --primary-color: #0D4F27; /* Verde escuro */
    --secondary-color: #3E8E41; /* Verde médio */
    --accent-color: #D4A017; /* Amarelo terra */
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --gray-color: #6c757d;
    --light-gray: #e9ecef;
}
```

### Conteúdo

Para alterar o conteúdo do site, edite o arquivo `index.html`. As seções estão claramente divididas com comentários para facilitar a localização.

## 📱 Responsividade

O site foi desenvolvido seguindo a abordagem mobile-first e é totalmente responsivo, adaptando-se a diferentes tamanhos de tela:

- Smartphones (< 576px)
- Tablets (576px - 991px)
- Desktops (> 992px)

## 🔍 SEO

O site inclui meta tags básicas para SEO. Para melhorar ainda mais o SEO, considere:

- Adicionar um sitemap.xml
- Configurar o Google Analytics
- Implementar Schema.org markup

## 📈 Futuras Implementações

- Integração com CMS para blog/notícias
- Galeria de imagens/projetos
- Área de clientes/parceiros
- Multilíngue (PT/EN)

## 📄 Licença

Este projeto está sob a licença [Inserir tipo de licença].

---

Desenvolvido por [Sua Empresa] © 2023