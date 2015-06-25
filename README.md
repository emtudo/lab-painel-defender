# Um projeto painel de controle para o Artesaos Defender

Uma ideia de como seria.

## Screenshot

[![Build Status](https://github.com/emtudo/lab-painel-defender/blob/master/screenshot.png)](https://github.com/emtudo/lab-painel-defender/blob/master/screenshot.png)

### Meu primeiro código compartilhado

Vamos ver se presta ;)

###Como utilizar?

Para utilizar este mini-app siga os sequites passos:

1 - Crie a base de dados: emtudo_teste

2 - defina usuário e senha no .env ou em config/database.php

use o artisan

3 - php artisan migrate

4 - php artisan db:seed

5 - php artisan serve

Pronto! Poderá ver o a ideia.

###Observações:
O middleware VerifyCsrfToken está desativado, eu não testei, porém acredito que se ativá-lo tudo irá funcionar corretamente.

Tem vários lixos na aplicação, pois fiz um exugamento rápido de um projeto que estou utilizando.

O camarada que vai dá acesso a alguma permissão ou role, ele precisa ter permissão para a permissão que ele mesmo quer setar para outro, e mesmo que ele não tenha permissão em um grupo por exemplo "Financeiro", porém tem permissão ao grupo "Acesso total  ao sistema" e este "Acesso total ao sistema"  tem todas as permissões que tem no "Financeiro" ele poderá dá acesso ao financeiro então.