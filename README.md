# Gerador de Currículo - UNIPAR (Estrutura pronta)

## Instalação rápida (XAMPP)
1. Copie a pasta `gerador-curriculo-unipar` para `C:\xampp\htdocs\`.
2. Inicie Apache e MySQL no painel do XAMPP.
3. Abra `http://localhost/phpmyadmin` e importe `database/curriculo.sql`.
4. Acesse `http://localhost/gerador-curriculo-unipar/addUser.php` para criar um usuário de teste (nome, email, senha).
5. Faça login em `http://localhost/gerador-curriculo-unipar/index.php`.
6. Preencha `Dados Pessoais`, adicione `Formação` e `Experiência`. Visualize e imprima.

## Observações
- As senhas são armazenadas com `password_hash`.
- Use `includes/funcoes.php` para incluir/alterar funções de inserção.
- Evite expor `addUser.php` em produção — é apenas para teste.
- Para melhorar: adicionar upload de foto, edição/exclusão de registros, proteção CSRF, validações mais robustas.

Boa: se quiser eu já gero um ZIP com todos os arquivos prontos (ou disponibilizo o conteúdo em um único arquivo .sql/.zip) — quer que eu gere?  
Também posso adicionar rota de edição/exclusão e autenticação mais robusta.
