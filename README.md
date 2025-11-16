# AgroStock

O **AgroStock** é um sistema web de Gestão dee Estoque e Validade desenvolvido em **Laravel**. O objetivo principal é digitalizar o controle de estoque, reduzindo perdas causadas por produtos vencidos e otimizando a tomada de decisões de compra e descarte.

---

### Funcionalidades Principais

- **Autenticação de Usuário:** Login e Registro.
- **Dashboard:** Visão geral do valor total do estoque e alertas visuais de vencimento.
- **Gestão de Produtos:** CRUD completo para cadastro de itens, incluindo preço de custo e data de validade.
- **Controle de Validade:** Exibição de status de validade na tabela de produtos.
- **Alerta de Próximo Vencimento:** Notificações para produtos que vencem nos próximos 60 dias.

---

## 🛠️ Tecnologias Utilizadas

-**PHP | 8.2+**
-**Laravel | 12.0+**
**Laravel Breeze | ^2.3**
-**Livewire | ^3.6.4**
-**Livewire/Volt | ^1.7.0**
-**Tailwind Css | ^3.1.0**
-**MySQL | 8.0+** 

---

## Passo a passo para rodar o projeto

### 1) Clone o repositório

```bash
git clone https://github.com/joaolack/Routine_Up.git
cd Projeto-Agrop
```

### 2) Configure o ambiente

Crie o arquivo de ambiente e gere a chave do aplicativo:
```bash
cp .env.example .env
php artisan key:generate
```

> **Importante:** Edite o arquivo .env com suas credenciais de banco de dados (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

### 3) Instale as dependências

Instale as dependências PHP e Javascript:
```bash
composer install
npm install
```

### 4) Geração de Banco de Dados

```bash
php artisan migrate
```

### 5) Compilação do Frontend
```bash
npm run dev
```

### 6) Inicialização do Servidor

```bash
php artisan serve
```

---

## Contato
Desenvolvedor: João Gabriel Lack
Github: [https://github.com/joaolack](https://github.com/joaolack)