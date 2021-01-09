CREATE TABLE `grupo_usuario` (
  `gru_id` int(11) NOT NULL,
  `gru_nome` varchar(200) UNIQUE,
  `gru_status` char(1) NOT NULL
);

ALTER TABLE `grupo_usuario` ADD PRIMARY KEY (`gru_id`);

ALTER TABLE `grupo_usuario` MODIFY `gru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


CREATE TABLE `ger_acesso` (
  `ger_id` int(11) NOT NULL,
  `ger_gru_id` int(11) NOT NULL,
  `ger_clinica` char(1) DEFAULT 'N',
  `ger_dentista` char(1) DEFAULT 'N',
  `ger_fornecedor` char(1) DEFAULT 'N',
  `ger_funcionario` char(1) DEFAULT 'N',
  `ger_grupo` char(1) DEFAULT 'N',
  `ger_paciente` char(1) DEFAULT 'N',
  `ger_produto` char(1) DEFAULT 'N'
);

ALTER TABLE `ger_acesso` ADD PRIMARY KEY (`ger_id`);

ALTER TABLE `ger_acesso` MODIFY `ger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `ger_acesso` ADD CONSTRAINT `fk_ger_grupo1` FOREIGN KEY (`ger_gru_id`) REFERENCES `grupo_usuario` (`gru_id`);


CREATE TABLE `clinica` (
  `cli_id` int(11) NOT NULL,
  `cli_nome` varchar(200) NOT NULL,
  `cli_razao` varchar(200) NOT NULL,
  `cli_cnpj` varchar(20) NOT NULL,
  `cli_ie` varchar(20) NOT NULL,
  `cli_im` varchar(20) NOT NULL,
  `cli_cep` varchar(10) NOT NULL,
  `cli_logradouro` varchar(200) NOT NULL,
  `cli_complemento` varchar(200) NOT NULL,
  `cli_numero` varchar(10) NOT NULL,
  `cli_bairro` varchar(100) NOT NULL,
  `cli_cidade` varchar(200) NOT NULL,
  `cli_estado` varchar(50) NOT NULL,
  `cli_telefone` varchar(20) NOT NULL,
  `cli_celular` varchar(20) NOT NULL,
  `cli_email` varchar(200) NOT NULL,
  `cli_site` varchar(200) NOT NULL,
  `cli_logo` varchar(1000) NOT NULL
);

ALTER TABLE `clinica` ADD PRIMARY KEY (`cli_id`);

ALTER TABLE `clinica` MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


CREATE TABLE `funcionario` (
  `fun_id` int(11) NOT NULL,
  `fun_nome` varchar(200) NOT NULL,
  `fun_sexo` char(1) NOT NULL,
  `fun_dt_nasc` varchar(10) NOT NULL,
  `fun_cpf` varchar(20) UNIQUE,
  `fun_rg` varchar(20) NOT NULL,
  `fun_cep` varchar(10) NOT NULL,
  `fun_logradouro` varchar(200) NOT NULL,
  `fun_complemento` varchar(200) NOT NULL,
  `fun_numero` varchar(10) NOT NULL,
  `fun_bairro` varchar(100) NOT NULL,
  `fun_cidade` varchar(200) NOT NULL,
  `fun_estado` varchar(50) NOT NULL,
  `fun_telefone` varchar(20) NOT NULL,
  `fun_celular` varchar(20) NOT NULL,
  `fun_gru_id` int(11) NOT NULL,
  `fun_email` varchar(200) UNIQUE,
  `fun_senha` varchar(250) NOT NULL,
  `fun_status` char(1) NOT NULL
);

ALTER TABLE `funcionario` ADD PRIMARY KEY (`fun_id`);

ALTER TABLE `funcionario` MODIFY `fun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `funcionario` ADD CONSTRAINT `fk_fun_grupo1` FOREIGN KEY (`fun_gru_id`) REFERENCES `grupo_usuario` (`gru_id`);


CREATE TABLE `dentista` (
  `den_id` int(11) NOT NULL,
  `den_cro` varchar(50) NOT NULL,
  `den_nome` varchar(200) NOT NULL,
  `den_sexo` char(1) NOT NULL,
  `den_dt_nasc` varchar(10) NOT NULL,
  `den_cpf` varchar(20) UNIQUE,
  `den_rg` varchar(20) NOT NULL,
  `den_cep` varchar(10) NOT NULL,
  `den_logradouro` varchar(200) NOT NULL,
  `den_complemento` varchar(200) NOT NULL,
  `den_numero` varchar(10) NOT NULL,
  `den_bairro` varchar(100) NOT NULL,
  `den_cidade` varchar(200) NOT NULL,
  `den_estado` varchar(50) NOT NULL,
  `den_telefone` varchar(20) NOT NULL,
  `den_celular` varchar(20) NOT NULL,
  `den_gru_id` int(11) NOT NULL,
  `den_email` varchar(200) UNIQUE,
  `den_senha` varchar(250) NOT NULL,
  'den_cor' varchar(100) NOT NULL,
  `den_status` char(1) NOT NULL
);

ALTER TABLE `dentista` ADD PRIMARY KEY (`den_id`);

ALTER TABLE `dentista` MODIFY `den_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `dentista` ADD CONSTRAINT `fk_den_grupo1` FOREIGN KEY (`den_gru_id`) REFERENCES `grupo_usuario` (`gru_id`);


CREATE TABLE `fornecedor` (
  `for_id` int(11) NOT NULL,
  `for_cnpj` varchar(20) UNIQUE,
  `for_ie` varchar(15) DEFAULT NULL,
  `for_razaosocial` varchar(150) DEFAULT NULL,
  `for_fantasia` varchar(150) DEFAULT NULL,
  `for_logradouro` varchar(200) DEFAULT NULL,
  `for_numero` varchar(10) DEFAULT NULL,
  `for_complemento` varchar(100) DEFAULT NULL,
  `for_bairro` varchar(100) DEFAULT NULL,
  `for_cep` varchar(10) DEFAULT NULL,
  `for_cidade` varchar(100) DEFAULT NULL,
  `for_contato` varchar(100) DEFAULT NULL,
  `for_estado` varchar(50) DEFAULT NULL,
  `for_telefone` varchar(20) DEFAULT NULL,
  `for_celular` varchar(20) DEFAULT NULL,
  `for_email` varchar(150) DEFAULT NULL,
  `for_status` char(1) DEFAULT NULL
);

ALTER TABLE `fornecedor` ADD PRIMARY KEY (`for_id`);

ALTER TABLE `fornecedor` MODIFY `for_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


CREATE TABLE `produto` (
  `pro_id` int(11) NOT NULL,
  `pro_barras` varchar(200) NOT NULL,
  `pro_descricao` varchar(200) NOT NULL,
  `pro_unidade` varchar(20) NOT NULL,
  `pro_ult_vl` decimal(10,2) NOT NULL,
  `pro_vl_vend` decimal(10,2) NOT NULL,
  `pro_status` char(1) NOT NULL
);

ALTER TABLE `produto` ADD PRIMARY KEY (`pro_id`); 

ALTER TABLE `produto` MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


CREATE TABLE `paciente` (
  `pac_id` int(11) NOT NULL,
  `pac_cpf` varchar(20) DEFAULT NULL,
  `pac_rg` varchar(20) DEFAULT NULL,
  `pac_nome` varchar(150) DEFAULT NULL,
  `pac_sexo` char(1) DEFAULT NULL,
  `pac_sangue` varchar(5) DEFAULT NULL,
  `pac_logradouro` varchar(200) DEFAULT NULL,
  `pac_numero` varchar(10) DEFAULT NULL,
  `pac_complemento` varchar(100) DEFAULT NULL,
  `pac_bairro` varchar(100) DEFAULT NULL,
  `pac_cep` varchar(10) DEFAULT NULL,
  `pac_cidade` varchar(100) DEFAULT NULL,
  `pac_estado` varchar(50) DEFAULT NULL,
  `pac_dt_nasc` varchar(20) DEFAULT NULL,
  `pac_telefone` varchar(20) DEFAULT NULL,
  `pac_celular` varchar(20) DEFAULT NULL,
  `pac_email` varchar(150) DEFAULT NULL,
  `pac_musica` varchar(150) DEFAULT NULL,
  `pac_dent_id` int(11) NOT NULL,
  `pac_status` char(1) DEFAULT NULL
);

ALTER TABLE `paciente` ADD PRIMARY KEY (`pac_id`);

ALTER TABLE `paciente` MODIFY `pac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `paciente` ADD CONSTRAINT `fk_pac_dentista1` FOREIGN KEY (`pac_dent_id`) REFERENCES `dentista` (`den_id`);


CREATE TABLE `agendamento` (
  `age_id` int(11) NOT NULL,
  `age_pac_id` int(11) NOT NULL,
  `age_den_id` int(11) NOT NULL,
  `age_inicio` datetime DEFAULT NULL,
  `age_fim` datetime DEFAULT NULL,
  `age_tipo` varchar(100) DEFAULT NULL,
  `age_obs` varchar(500) DEFAULT NULL,
  `age_status` varchar(20) DEFAULT NULL
);

ALTER TABLE `agendamento` ADD PRIMARY KEY (`age_id`);

ALTER TABLE `agendamento` MODIFY `age_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `agendamento` ADD CONSTRAINT `fk_age_paciente1` FOREIGN KEY (`age_pac_id`) REFERENCES `paciente` (`pac_id`);
ALTER TABLE `agendamento` ADD CONSTRAINT `fk_age_dentista1` FOREIGN KEY (`age_den_id`) REFERENCES `dentista` (`den_id`);