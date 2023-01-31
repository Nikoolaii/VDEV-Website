import { MigrationInterface, QueryRunner } from 'typeorm'

export class InitDB1675161864924 implements MigrationInterface {
  name = 'InitDB1675161864924'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `CREATE TABLE \`periode\` (\`id\` int NOT NULL AUTO_INCREMENT, \`debut\` datetime NOT NULL, \`fin\` datetime NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`type\` (\`id\` varchar(255) NOT NULL, \`nom\` varchar(255) NOT NULL, \`categorieLettre\` varchar(255) NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`reservation\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, \`prenom\` varchar(255) NOT NULL, \`addresse\` varchar(255) NOT NULL, \`code_postal\` varchar(255) NOT NULL, \`ville\` varchar(255) NOT NULL, \`quantite\` int NOT NULL, \`typeId\` varchar(255) NULL, \`traverseeId\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`secteur\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`port\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`liaison\` (\`id\` int NOT NULL AUTO_INCREMENT, \`distance\` int NOT NULL, \`secteurId\` int NULL, \`departId\` int NULL, \`arriveeId\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`traversee\` (\`id\` int NOT NULL AUTO_INCREMENT, \`date\` datetime NOT NULL, \`heure\` time NOT NULL, \`bateauId\` int NULL, \`liaisonId\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`bateau\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, \`longueur\` int NOT NULL, \`largeur\` int NOT NULL, \`vitesse\` int NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`categorie\` (\`lettre\` varchar(255) NOT NULL, \`nom\` varchar(255) NOT NULL, \`capacite_max\` int NOT NULL, \`bateauId\` int NULL, PRIMARY KEY (\`lettre\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`tarif\` (\`id\` int NOT NULL AUTO_INCREMENT, \`prix\` int NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`user\` (\`id\` int NOT NULL AUTO_INCREMENT, \`email\` varchar(255) NOT NULL, \`password\` varchar(255) NOT NULL, \`first_name\` varchar(255) NOT NULL, \`last_name\` varchar(255) NOT NULL, UNIQUE INDEX \`IDX_e12875dfb3b1d92d7d7c5377e2\` (\`email\`), PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`equipement\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `ALTER TABLE \`type\` ADD CONSTRAINT \`FK_851c356e4347fa6c6ca67ea5345\` FOREIGN KEY (\`categorieLettre\`) REFERENCES \`categorie\`(\`lettre\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_8a49f5ec716289d21900a123592\` FOREIGN KEY (\`typeId\`) REFERENCES \`type\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_7698c4ef0b0c077b3913c472413\` FOREIGN KEY (\`traverseeId\`) REFERENCES \`traversee\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD CONSTRAINT \`FK_f35d4a71abf0b6a9e32f6447e6c\` FOREIGN KEY (\`secteurId\`) REFERENCES \`secteur\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD CONSTRAINT \`FK_2aed78185babe844da3bfa9796d\` FOREIGN KEY (\`departId\`) REFERENCES \`port\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD CONSTRAINT \`FK_6eab6550784b604d13da2c8cda8\` FOREIGN KEY (\`arriveeId\`) REFERENCES \`port\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` ADD CONSTRAINT \`FK_1596b8ab29d6f70c0cdf2787da9\` FOREIGN KEY (\`bateauId\`) REFERENCES \`bateau\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` ADD CONSTRAINT \`FK_7af585af64f0b558fd207585a60\` FOREIGN KEY (\`liaisonId\`) REFERENCES \`liaison\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`categorie\` ADD CONSTRAINT \`FK_4a17ad87f1ce19a17659dd4a53a\` FOREIGN KEY (\`bateauId\`) REFERENCES \`bateau\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`categorie\` DROP FOREIGN KEY \`FK_4a17ad87f1ce19a17659dd4a53a\``
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` DROP FOREIGN KEY \`FK_7af585af64f0b558fd207585a60\``
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` DROP FOREIGN KEY \`FK_1596b8ab29d6f70c0cdf2787da9\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` DROP FOREIGN KEY \`FK_6eab6550784b604d13da2c8cda8\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` DROP FOREIGN KEY \`FK_2aed78185babe844da3bfa9796d\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` DROP FOREIGN KEY \`FK_f35d4a71abf0b6a9e32f6447e6c\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_7698c4ef0b0c077b3913c472413\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_8a49f5ec716289d21900a123592\``
    )
    await queryRunner.query(
      `ALTER TABLE \`type\` DROP FOREIGN KEY \`FK_851c356e4347fa6c6ca67ea5345\``
    )
    await queryRunner.query(`DROP TABLE \`equipement\``)
    await queryRunner.query(
      `DROP INDEX \`IDX_e12875dfb3b1d92d7d7c5377e2\` ON \`user\``
    )
    await queryRunner.query(`DROP TABLE \`user\``)
    await queryRunner.query(`DROP TABLE \`tarif\``)
    await queryRunner.query(`DROP TABLE \`categorie\``)
    await queryRunner.query(`DROP TABLE \`bateau\``)
    await queryRunner.query(`DROP TABLE \`traversee\``)
    await queryRunner.query(`DROP TABLE \`liaison\``)
    await queryRunner.query(`DROP TABLE \`port\``)
    await queryRunner.query(`DROP TABLE \`secteur\``)
    await queryRunner.query(`DROP TABLE \`reservation\``)
    await queryRunner.query(`DROP TABLE \`type\``)
    await queryRunner.query(`DROP TABLE \`periode\``)
  }
}
