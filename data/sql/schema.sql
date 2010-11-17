CREATE TABLE estudante (usuario_id BIGINT, matricula VARCHAR(20) NOT NULL, telefone VARCHAR(14), PRIMARY KEY(usuario_id));
CREATE TABLE professor (usuario_id BIGINT, instituicao VARCHAR(255) NOT NULL, titulacao VARCHAR(30) NOT NULL, experiencia BIGINT, substituto BOOLEAN, comissao BOOLEAN, PRIMARY KEY(usuario_id));
CREATE TABLE projeto (id BIGSERIAL, titulo VARCHAR(255) NOT NULL, estudante_id BIGINT NOT NULL, professor_id BIGINT NOT NULL, coorientadores VARCHAR(255), data_requisicao DATE, data_sugestao DATE, data_aprovacao DATE, data_autorizacao DATE, documento VARCHAR(255), documento_final VARCHAR(255), qtde_linhas BIGINT, PRIMARY KEY(id));
CREATE TABLE sf_guard_user (id BIGSERIAL, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active BOOLEAN DEFAULT 'true', is_super_admin BOOLEAN DEFAULT 'false', last_login TIMESTAMP, created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(id));
CREATE TABLE sf_guard_forgot_password (id BIGSERIAL, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at TIMESTAMP NOT NULL, created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(id));
CREATE TABLE sf_guard_group (id BIGSERIAL, name VARCHAR(255) UNIQUE, description VARCHAR(1000), created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(id));
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(group_id, permission_id));
CREATE TABLE sf_guard_permission (id BIGSERIAL, name VARCHAR(255) UNIQUE, description VARCHAR(1000), created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(id));
CREATE TABLE sf_guard_remember_key (id BIGSERIAL, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(id));
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(user_id, group_id));
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at TIMESTAMP NOT NULL, updated_at TIMESTAMP NOT NULL, PRIMARY KEY(user_id, permission_id));
CREATE INDEX is_active_idx ON sf_guard_user (is_active);
ALTER TABLE projeto ADD CONSTRAINT projeto_professor_id_professor_id FOREIGN KEY (professor_id) REFERENCES professor(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE projeto ADD CONSTRAINT projeto_estudante_id_estudante_id FOREIGN KEY (estudante_id) REFERENCES estudante(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
