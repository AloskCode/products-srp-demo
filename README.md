Thiago Okada Aoki
RA 2002282
#  Projeto — Cadastro e Listagem de Produtos (SRP + PSR-4 + PHP)

Este projeto demonstra um sistema simples de **cadastro e listagem de produtos** feito em **PHP puro**, aplicando **SRP (Single Responsibility Principle)** e **PSR-4 (Composer autoload)**.  
Não há banco de dados — os produtos são armazenados em um arquivo texto (`storage/products.txt`), um **JSON por linha**.

---

## Objetivo
Aprender e aplicar os princípios:
- **SRP** — separar responsabilidades (validação, aplicação e persistência)
- **PSR-4** — organização e autoload de classes
- **Camadas organizadas**: `Application`, `Domain`, `Infra`, `Contracts`
- Persistência em **arquivo texto JSON por linha**

---

## 🗂️ Estrutura do Projeto

```bash
products-srp-demo/
├─ composer.json
├─ vendor/
├─ src/
│ ├─ Contracts/
│ │ ├─ ProductRepository.php
│ │ └─ ProductValidator.php
│ ├─ Application/
│ │ └─ ProductService.php
│ ├─ Domain/
│ │ └─ SimpleProductValidator.php
│ └─ Infra/
│ └─ FileProductRepository.php
├─ public/
│ ├─ index.php
│ ├─ create.php
│ └─ products.php
└─ storage/
└─ products.txt
```


## Como usar (Windows + XAMPP)
1. Coloque a pasta `products-srp-demo` dentro do `htdocs` do XAMPP.
2. Instale o Composer se necessário e rode na raiz do projeto:
   ```
   composer dump-autoload
   ```
3. Acesse via navegador:
   `http://localhost/products-srp-demo/public/`

## Endpoints
- `public/index.php` — formulário para criar produto (POST -> create.php)
- `public/create.php` — recebe POST, valida e salva
- `public/products.php` — lista produtos

## Casos de teste manuais (conforme enunciado)
1. **Cadastro válido**
   - Input: name="Teclado", price=120.50
   - Esperado: HTTP 201, produto aparece em `products.php`

2. **Nome curto**
   - Input: name="T", price=50
   - Esperado: HTTP 422, mensagem de validação

3. **Preço negativo**
   - Input: name="Mouse", price=-10
   - Esperado: HTTP 422, mensagem de validação

4. **Lista vazia**
   - Apagar `storage/products.txt` ou deixá-lo vazio
   - `products.php` mostra "Nenhum produto cadastrado"

5. **Múltiplos cadastros**
   - Criar 3 produtos e verificar IDs incrementais 1,2,3
