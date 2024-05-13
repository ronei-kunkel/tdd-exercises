# TDD-EXERCISES

## Steps

### with docker

`docker build --no-cache -t tdd-exercises:latest . && docker run -it --rm tdd-exercises`

1. build image: `docker build -t tdd-exercises:latest .`

2. run tests: `docker run -it --rm tdd-exercises`

### with docker compose for development

- build image and run tests: `docker compose up --build`

## Explicação para o eu lírico do futuro

Utilizo do multistage build do docker para, em uma imagem intermediária baseada na imagem do composer, copiar os arquivos de desenvolvimento do projeto.
Nessa imagem intermediária, com o composer que veio da imagem do composer, faço a instalação das dependências.

Em um outro estágio que é o da imagem final, utilizando como base a imagem de cli do php em cima do alpine linux, apenas copio o binário do composer e toda a pasta da aplicação que teve as dependencias instaladas pela etapa baseada na imagem do composer.

Isso torna a imagem final muito mais leve e evita que seja necessário fazer bind do volume da pasta vendor por exemplo.
Também deixa a aplicação completamente isolada, além de evitar que a vendor esteja ocupando espaço tanto no container quanto no host.
