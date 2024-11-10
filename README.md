<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Banco de dados V 1.0.0

CREATE TABLE dominio (
    dominio_id INT PRIMARY KEY,
    dominio_acesso_id INT,
    dominio_nome VARCHAR(100),
    dominio_link VARCHAR(255),
    FOREIGN KEY (dominio_acesso_id) REFERENCES acesso(acesso_id)
);

CREATE TABLE acesso (
    acesso_id INT PRIMARY KEY,
    acesso_usuario_id INT,
    acesso_dt_cadastro TIMESTAMP,
    acesso_dt_atualizacao TIMESTAMP,
    acesso_id_dominio INT,
    acesso_situacao CHAR(1),
    FOREIGN KEY (acesso_usuario_id) REFERENCES usuario(acesso_usuario_id)
);

CREATE TABLE acesso_perfil (
    acesso_perfil_id INT AUTO_INCREMENT PRIMARY KEY, 
    acesso_perfil_perfil_id INT,
    acesso_perfil_acesso_id INT,
    FOREIGN KEY (acesso_perfil_perfil_id) REFERENCES perfil(perfil_id),
    FOREIGN KEY (acesso_perfil_acesso_id) REFERENCES acesso(acesso_id)
);

CREATE TABLE perfil (
    perfil_id INT AUTO_INCREMENT PRIMARY KEY,
    perfil_nome VARCHAR(100) NOT NULL,
    perfil_descricao VARCHAR(255),
    perfil_dt_cadastro TIMESTAMP  TIMESTAMP,
    perfil_dt_atualizacao TIMESTAMP  TIMESTAMP
);

CREATE TABLE regras_perfil (
    regras_perfil_id INT PRIMARY KEY,
    regras_perfil_regra_id INT,
    regras_perfil_perfil_id INT,
    FOREIGN KEY (regras_perfil_regra_id) REFERENCES regras(regra_id),
    FOREIGN KEY (regras_perfil_perfil_id) REFERENCES perfis(perfil_id)
);


CREATE TABLE usuario (
    usuario_id INT PRIMARY KEY,
    usuario_cpf VARCHAR(14) NOT NULL,
    usuario_matricula VARCHAR(100) NOT NULL,
    usuario_email VARCHAR(255) NOT NULL,
    usuario_login VARCHAR(50) NOT NULL,
    usuario_senha VARCHAR(64) NOT NULL,
    usuario_professor_id INT,
    usuario_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario_situacao CHAR(1) NOT NULL,
    usuario_dt_exp_senha TIMESTAMP,
    usuario_qt_tentativa_senha INT DEFAULT 0
);

CREATE TABLE usuario_cliente (
    usuario_cliente_id INT PRIMARY KEY,
    usuario_cliente_usuario_id INT,
    usuario_cliente_cliente_id INT,
    usuario_cliente_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_cliente_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario_cliente_dt_expiracao TIMESTAMP,
    FOREIGN KEY (usuario_cliente_usuario_id) REFERENCES usuario(usuario_id),
    FOREIGN KEY (usuario_cliente_cliente_id) REFERENCES cliente(cliente_id)
);

CREATE TABLE endereco (
    endereco_id INT PRIMARY KEY,
    endereco_cliente_id INT,
    endereco_logradouro VARCHAR(100),
    endereco_numero VARCHAR(10),
    endereco_complemento VARCHAR(50),
    endereco_bairro VARCHAR(50),
    endereco_cidade VARCHAR(50),
    endereco_uf CHAR(2),
    endereco_cep VARCHAR(8),
    endereco_pais VARCHAR(50),
    endereco_dt_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    endereco_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (endereco_cliente_id) REFERENCES cliente(cliente_id)
);

CREATE TABLE cliente (
    cliente_id INT PRIMARY KEY,
    cliente_nome VARCHAR(255) NOT NULL,
    cliente_cpf VARCHAR(14) NOT NULL,
    cliente_rg VARCHAR(15),
    cliente_email VARCHAR(255),
    cliente_telefone VARCHAR(15),
    cliente_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cliente_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    cliente_dt_nascimento TIMESTAMP,
    cliente_id_escolaridade INT,
    cliente_genero CHAR(1),
    cliente_periodo_preferencia VARCHAR(50),
    cliente_horario_preferencia VARCHAR(50),
    cliente_atend_preferencia VARCHAR(50),
    cliente_st_confirma_dados CHAR(1)
);

CREATE TABLE cliente_necessidade (
    cliente_necessidade_id INT PRIMARY KEY,
    cliente_necessidade_necessidade_id INT,
    cliente_necessidade_cliente_id INT,
    FOREIGN KEY (cliente_necessidade_necessidade_id) REFERENCES necessidade(necessidade_id),
    FOREIGN KEY (cliente_necessidade_cliente_id) REFERENCES cliente(cliente_id)
);

CREATE TABLE necessidade (
    necessidade_id INT PRIMARY KEY,
    necessidade_nome VARCHAR(100) NOT NULL
);

CREATE TABLE prontuario (
    prontuario_id INT PRIMARY KEY,
    prontuario_cliente_id INT,
    prontuario_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    prontuario_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    prontuario_tx_historico_familiar VARCHAR(3000),
    prontuario_tx_historico_social VARCHAR(3000),
    prontuario_tx_consideracoes VARCHAR(3000),
    prontuario_tx_observacao VARCHAR(3000),
    prontuario_st_validacao_prof CHAR(1),
    FOREIGN KEY (prontuario_cliente_id) REFERENCES cliente(cliente_id)
);

CREATE TABLE contato (
    contato_id INT PRIMARY KEY,
    contato_cliente_id INT,
    contato_nome VARCHAR(255) NOT NULL,
    contato_telefone VARCHAR(15),
    contato_situacao CHAR(1),
    contato_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    contato_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    contato_prioridade INT,
    contato_emergencia CHAR(1),
    FOREIGN KEY (contato_cliente_id) REFERENCES cliente(cliente_id)
);

CREATE TABLE cliente_arquivo (
    cliente_arquivo_id INT PRIMARY KEY,
    cliente_arquivo_cliente_id INT,
    cliente_arquivo_arquivo_id INT,
    FOREIGN KEY (cliente_arquivo_cliente_id) REFERENCES cliente(cliente_id),
    FOREIGN KEY (cliente_arquivo_arquivo_id) REFERENCES arquivo(arquivo_id)
);

CREATE TABLE sessao (
    sessao_id INT PRIMARY KEY,
    sessao_prontuario_id INT,
    sessao_dt_inicio TIMESTAMP,
    sessao_dt_fim TIMESTAMP,
    sessao_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    sessao_dt_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    sessao_tx_principal VARCHAR(3000),
    sessao_tx_procedimento VARCHAR(3000),
    sessao_tx_encaminhamento VARCHAR(1000),
    sessao_tx_observacao VARCHAR(3000),
    sessao_st_presenca CHAR(1),
    sessao_st_confirmado CHAR(1),
    FOREIGN KEY (sessao_prontuario_id) REFERENCES prontuario(prontuario_id)
);

CREATE TABLE arquivos (
    arquivos_id INT PRIMARY KEY,
    arquivos_url VARCHAR(255) NOT NULL,
    arquivos_dt_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    arquivos_usuario_id INT,
    FOREIGN KEY (arquivos_usuario_id) REFERENCES usuario(usuario_id)
);

