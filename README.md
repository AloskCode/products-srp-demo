Thiago Okada Aoki
RA 2002282

Projeto em PHP puro aplicando SRP e PSR-4 (Composer autoload).
Estrutura mínima para cadastro e listagem de produtos usando arquivo (JSON).

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

## Observações
- Projeto usa persistência simples: `storage/products.txt` com JSON por linha.
- PSR-12 e SRP foram considerados em organização: contratos, domínio (validador),
  infra (repositório de arquivo) e application (serviço).
