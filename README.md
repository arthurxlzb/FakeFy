# 🎧 FakeFy - Projeto de Sistema de Músicas com Laravel e Docker

Esse projeto é um sistema de músicas que eu desenvolvi inspirado no Spotify. Ele foi feito com Laravel e roda tudo dentro do Docker, o que facilita bastante pra não ter que ficar configurando tudo na mão em cada computador.

Tive como objetivo aprender mais sobre Laravel, organização de código, uso de filas com Redis, e também como usar Docker pra montar um ambiente completo.

---

## 🚀 Tecnologias que usei

- Laravel
- MySQL
- Redis
- NGINX
- Docker / Docker Compose

---

## 🧩 Como rodar o projeto

Se você nunca mexeu com Docker, relaxa. Aqui vai o passo a passo certinho:

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/fakefy.git
cd fakefy

2. Copie o arquivo .env
"cp .env.example .env"


3. Suba o projeto com Docker
"docker compose up -d --build"


4. Instale as dependências
"docker compose exec app composer install"


5. Gere a chave da aplicação
"docker compose exec app php artisan key:generate"


6. Rode as migrations e os dados iniciais
"docker compose exec app php artisan migrate --seed"


Depois disso, o sistema deve estar disponível no navegador em:
http://localhost:8080


⚠️ Possíveis erros que aconteceram comigo e como resolvi
Erro: "permission denied while trying to connect to the Docker daemon socket"
Esse erro aconteceu em algumas máquinas porque o usuário não tinha permissão pra usar o Docker.

O que eu fiz:
"sudo usermod -aG docker $USER"

Depois disso, reiniciei o computador. 
Isso já resolveu.

Docker instalado via Snap
Em alguns casos, o Docker foi instalado pelo Snap e isso causou problemas de permissão, mesmo adicionando o usuário ao grupo.

Como resolvi:

Desinstalei a versão via Snap e instalei a oficial, seguindo esse link:

-> https://docs.docker.com/engine/install/ubuntu/

Porta 8080 já está sendo usada
Teve uma vez que outro programa estava usando a porta 8080, e por isso o sistema não abria.

O que fiz:

Mudei no docker-compose.yml:

ports:
  - "8081:80"
E acessei http://localhost:8081 no navegador.

Problemas com cache e banco
Se aparecer erro com rota, cache ou banco de dados, esses comandos ajudaram bastante:

"docker compose exec app php artisan config:clear"
"docker compose exec app php artisan cache:clear"
"docker compose exec app php artisan route:clear"
"docker compose exec app php artisan migrate:fresh --seed"


📁 Estrutura resumida do projeto
.
├── app/                  → Código Laravel
├── database/             → Migrations e Seeds
├── docker/               → Configurações do ambiente
├── public/               → Pasta pública
├── resources/            → Views, CSS, JS
├── routes/               → Rotas do sistema
├── docker-compose.yml    → Arquivo principal do Docker
└── README.md             → O arquivo que você está lendo
