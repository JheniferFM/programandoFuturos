# Programando Futuros - Laravel + Laragon / XAMPP

Este repositório contém o projeto **Programando Futuros**, migrado para **PHP + Laravel**, com a estrutura inicial pronta para desenvolvimento em equipe.

---

## 📖 Guia de Configuração

### 1️⃣ Instalar e testar o Laragon

1. Baixe e instale: [Laragon Download](https://laragon.org/download/)
2. Abra o Laragon e clique em **Start All** (Apache e MySQL).
3. Teste o PHP:
   * Crie `C:\laragon\www\info.php`:

     ```php
     <?php phpinfo();
     ```
   * Acesse: [http://localhost/info.php](http://localhost/info.php)  
   * Se aparecer o **phpinfo()**, está funcionando.

---

### 2️⃣ Ativar extensões do PHP

1. No Laragon: **Menu → PHP → php.ini**
2. Localize e habilite (remova `;` do início):

   ```ini
   extension=fileinfo
   extension=intl
   extension=pdo_mysql
   extension=openssl
   ```
3. Reinicie: **Menu → Restart All**
4. Confirme no `phpinfo()` que todas estão **enabled**.

---

### 3️⃣ Configurar Auto Virtual Hosts (opcional)

1. Laragon → **Menu → Preferences → General → Auto Virtual Hosts → On**
2. Document Root: `C:\laragon\www`
3. Reinicie o Laragon.
4. Agora `C:\laragon\www\NOME` → `http://NOME.test`

---

### 4️⃣ Criar o projeto Laravel

No **Terminal do Laragon**:

```bash
cd C:\laragon\www
composer create-project laravel/laravel programandofuturos
cd programandofuturos
php artisan key:generate
php artisan storage:link
```

---

### 5️⃣ Configurar banco de dados

1. No Laragon → **Menu → Database → HeidiSQL** (ou phpMyAdmin).
2. Crie o banco: `programandofuturos`
3. Edite `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=programandofuturos
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Execute as migrations:

   ```bash
   php artisan migrate
   ```

---

### 6️⃣ Testar Laravel no navegador

* Sem Auto Virtual Host:  
  👉 [http://localhost/programandofuturos/public](http://localhost/programandofuturos/public)

* Com Auto Virtual Host:  
  👉 [http://programandofuturos.test](http://programandofuturos.test)

---

### 7️⃣ Adicionar autenticação (Laravel Breeze)

No terminal, dentro do projeto:

```bash
composer require laravel/breeze --dev
php artisan breeze:install vue
npm install
npm run dev
php artisan migrate
```

🔑 Isso gera:
* Login e cadastro de usuários
* Reset de senha
* Dashboard inicial

Acesse: [http://programandofuturos.test/login](http://programandofuturos.test/login)

---

### 8️⃣ Estrutura recomendada

* **Views:** `resources/views`
* **Layouts:** `resources/views/layouts/app.blade.php`
* **Vue Components:** `resources/js/components`
* **Assets:** `resources/css`, `resources/js`
* **Controllers:** `app/Http/Controllers`
* **Models:** `app/Models`
* **Rotas:** `routes/web.php`

---

### 9️⃣ Próximos passos

- Migrar páginas existentes para **Blade** (home, sobre, trilhas, etc.).
- Migrar scripts JS para **Vite/Vue**.
- Criar **Controllers** e **Models** para lógica de dados.
- Configurar menus, dashboard e formulários.

---

## ⚡ Rodando com XAMPP

Se preferir usar o **XAMPP** ao invés do Laragon, siga este passo a passo:

### 1. Ligar o XAMPP
1. Abra o **Painel de Controle do XAMPP**.  
2. Clique em **Start** para os módulos **Apache** e **MySQL**.  
3. Espere ficarem verdes → o servidor web e banco de dados estarão ativos.  
*(Pode minimizar o painel, mas não feche.)*

---

### 2. Iniciar o Back-end (Laravel)
1. Abra um **terminal**.  
2. Navegue até a pasta do projeto:

   ```bash
   cd C:\Users\marco\programandoFuturos
   ```
3. Rode o servidor do Laravel:

   ```bash
   php artisan serve
   ```
4. O terminal mostrará a URL da aplicação (ex.: `http://127.0.0.1:8000`).  
   *Deixe este terminal aberto.*

---

### 3. Iniciar o Front-end (Vite)
1. Abra **outro terminal** (mantenha o anterior aberto).  
2. Novamente, vá até a pasta do projeto:

   ```bash
   cd C:\Users\marco\programandoFuturos
   ```
3. Rode o Vite:

   ```bash
   npm run dev
   ```
4. Este terminal vai compilar CSS/JS.  
   *Deixe aberto enquanto desenvolve.*

---

### 4. Acessar a aplicação
Abra seu navegador e vá até:  
👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

### 📌 Resumo rápido
1. Ligar XAMPP (Apache + MySQL)  
2. Terminal 1:  

   ```bash
   cd programandoFuturos
   php artisan serve
   ```
3. Terminal 2:  

   ```bash
   cd programandoFuturos
   npm run dev
   ```
4. Acessar: `http://127.0.0.1:8000`

---

### 🛑 Como parar tudo
- Em cada terminal → pressione **Ctrl + C**.  
- No painel do XAMPP → clique em **Stop** no Apache e MySQL.  

---

## 👥 Trabalho em equipe

1. Clone o repositório:

   ```bash
   git clone https://github.com/SEU-USUARIO/programandoFuturos.git
   cd programandoFuturos
   ```

2. Crie e use a branch de desenvolvimento:

   ```bash
   git checkout -b develop
   ```

⚠️ Todos precisam ter instalados:
- Laragon ou XAMPP  
- PHP  
- Composer  
- Node.js / NPM  

---

🚀 Pronto! Agora é só codar com Laravel e organizar as trilhas do **Programando Futuros**.
