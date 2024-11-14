## CREATE DB
'''
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

'''
