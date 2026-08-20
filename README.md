# Painel de Documentação — Terrenos Carvalho

Painel de acompanhamento da documentação dos terrenos da incorporadora Carvalho. Criado para o Kauã registrar a posição diária e para a gestão acompanhar prazos, pendências e quem está travando cada etapa.

## Terrenos acompanhados

- **Guajiru** — São Miguel do Gostoso
- **Uhane** — São Miguel do Gostoso
- **Jobiana** — Touros
- **Rua dos Camarões** — São Miguel do Gostoso (prioridade máxima — casas em fase final de construção)

## O que o painel mostra, por terreno

- **Status / pendência atual** e **quem está cobrando** — campos de texto livre, editáveis.
- **Próximas etapas** — checklist do caminho da documentação (ex.: correção de topografia → nova matrícula → alvará de construção → habite-se/certidão de característica → averbação → venda → financiamento), com a etapa atual marcada.
- **Diário de acompanhamento** — histórico de registros (data, responsável, o que foi combinado) que **não pode ser reescrito**, só complementado com novos registros. Cada registro aceita até 3 prazos prometidos, para deixar visível quando algo foi reprogramado mais de uma vez.
- **Última atualização** — data da última vez que o card foi salvo.

## Como usar

1. Abra `index.html` no navegador (ou pelo link do GitHub Pages, se estiver ativado neste repositório).
2. Edite os campos de status, próximas etapas e adicione registros no diário conforme a posição do dia.
3. Clique em **Salvar** em cada card para gravar as mudanças de status/etapas. Registros do diário salvam sozinhos ao clicar em **Adicionar registro**.

Os dados ficam salvos em um arquivo no próprio servidor (`terrenos-data.json`, gerado automaticamente), através do script `data.php`. Isso significa que o painel **precisa ser hospedado em um servidor com PHP** (como o cPanel já usado neste projeto) — abrir o `index.html` direto do computador, sem passar por um servidor PHP, faz o salvamento falhar.

Qualquer pessoa que abrir a página vê e pode preencher as mesmas informações — não é uma cópia separada por pessoa ou navegador.

### Requisito de permissão no servidor

A pasta onde o `index.html` e o `data.php` estão precisa permitir que o PHP crie e edite arquivos nela (para gerar o `terrenos-data.json`). Se o salvamento não funcionar, o primeiro lugar a checar é a permissão de escrita da pasta no cPanel.

## Modo administrador

Por padrão, qualquer pessoa pode **adicionar** informações, mas ninguém pode apagar ou reescrever um registro do diário — isso preserva o histórico mesmo que alguém erre ou tente mudar um prazo já combinado.

Quem souber o PIN de administrador pode entrar em modo admin (botão no topo do painel) e **excluir** registros indevidos. O PIN fica definido na constante `ADMIN_PIN` dentro do arquivo HTML — troque-o antes de distribuir o link.

> Importante: isso é uma trava simples, não um sistema de autenticação de verdade. Qualquer pessoa com acesso ao código-fonte do arquivo consegue contornar essa proteção. Não é o ambiente indicado para dados sigilosos ou financeiros sensíveis.

## Publicar como link

Para o Kauã (ou qualquer pessoa fora deste repositório) acessar o painel pelo navegador sem precisar baixar o arquivo, ative o **GitHub Pages**:

`Settings → Pages → Branch: main → Save`

O link fica em:
`https://luizmuniztravus.github.io/documentacao-terrenos/`
