import { MigrationInterface, QueryRunner } from 'typeorm'

export class Initialisation1677764304213 implements MigrationInterface {
  name = 'Initialisation1677764304213'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `CREATE TABLE \`secteur\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`port\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`periode\` (\`id\` int NOT NULL AUTO_INCREMENT, \`debut\` datetime NOT NULL, \`fin\` datetime NOT NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`liaisons_types_periodes\` (\`liaison_id\` int NOT NULL, \`type_id\` int NOT NULL, \`periode_id\` int NOT NULL, \`tarif\` int NOT NULL, PRIMARY KEY (\`liaison_id\`, \`type_id\`, \`periode_id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`liaison\` (\`id\` int NOT NULL AUTO_INCREMENT, \`distance\` int NOT NULL, \`image_link\` varchar(255) NULL, \`secteur_id\` int NULL, \`depart_id\` int NULL, \`arrivee_id\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`traversee\` (\`id\` int NOT NULL AUTO_INCREMENT, \`date\` date NOT NULL, \`heure\` time NOT NULL, \`bateau_id\` int NULL, \`liaison_id\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`user\` (\`id\` int NOT NULL AUTO_INCREMENT, \`email\` varchar(255) NOT NULL, \`password\` varchar(255) NOT NULL, \`first_name\` varchar(255) NOT NULL, \`last_name\` varchar(255) NOT NULL, \`admin\` tinyint NOT NULL, UNIQUE INDEX \`IDX_e12875dfb3b1d92d7d7c5377e2\` (\`email\`), PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`reservation\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, \`prenom\` varchar(255) NOT NULL, \`addresse\` varchar(255) NOT NULL, \`code_postal\` varchar(255) NOT NULL, \`ville\` varchar(255) NOT NULL, \`traversee_id\` int NULL, \`user_id\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`type\` (\`id\` int NOT NULL AUTO_INCREMENT, \`libelle\` varchar(255) NOT NULL, \`categorie_lettre\` varchar(255) NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`categorie\` (\`lettre\` varchar(255) NOT NULL, \`nom\` varchar(255) NOT NULL, PRIMARY KEY (\`lettre\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`bateau\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, \`longueur\` int NULL, \`largeur\` int NULL, \`vitesse\` int NULL, \`poidsMax\` int NULL, \`type\` varchar(255) NOT NULL, INDEX \`IDX_2d13eac73f0a37a92888ddc3e6\` (\`type\`), PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`equipement\` (\`id\` int NOT NULL AUTO_INCREMENT, \`nom\` varchar(255) NOT NULL, \`bateauVoyageurId\` int NULL, PRIMARY KEY (\`id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`bateaux_categories\` (\`bateau_id\` int NOT NULL, \`categorie_lettre\` varchar(255) NOT NULL, \`capacite_max\` int NOT NULL, PRIMARY KEY (\`bateau_id\`, \`categorie_lettre\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `CREATE TABLE \`reservations_types\` (\`reservation_id\` int NOT NULL, \`type_id\` int NOT NULL, \`quantite\` int NOT NULL, PRIMARY KEY (\`reservation_id\`, \`type_id\`)) ENGINE=InnoDB`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` DROP COLUMN \`quantite\``
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` DROP COLUMN \`capacite_max\``
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` ADD \`capacite_max\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` ADD \`quantite\` int NOT NULL`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_c77bd1ac3d7815633ad0a44e95\` ON \`reservations_types\` (\`reservation_id\`)`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_349f1f97df962f636dbfc35e5e\` ON \`reservations_types\` (\`type_id\`)`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_3f7ff0073a7184b1dc1bc5d37e\` ON \`bateaux_categories\` (\`bateau_id\`)`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_c2d984f27752fb4beeecc0b4e3\` ON \`bateaux_categories\` (\`categorie_lettre\`)`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaisons_types_periodes\` ADD CONSTRAINT \`FK_8d1d9ad3d716ef86889f843569b\` FOREIGN KEY (\`liaison_id\`) REFERENCES \`liaison\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaisons_types_periodes\` ADD CONSTRAINT \`FK_926fdf69d04ce48f1b4db6f500a\` FOREIGN KEY (\`type_id\`) REFERENCES \`type\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaisons_types_periodes\` ADD CONSTRAINT \`FK_5b7849a8dad568791735fb1ae66\` FOREIGN KEY (\`periode_id\`) REFERENCES \`periode\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD CONSTRAINT \`FK_86bba15f1ebc026f7d975215fb2\` FOREIGN KEY (\`secteur_id\`) REFERENCES \`secteur\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD CONSTRAINT \`FK_2c535b02420afed5c72485732d5\` FOREIGN KEY (\`depart_id\`) REFERENCES \`port\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD CONSTRAINT \`FK_0a807ed929d7d7a597200e7d22f\` FOREIGN KEY (\`arrivee_id\`) REFERENCES \`port\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` ADD CONSTRAINT \`FK_e447c2cee3b4a41023032588943\` FOREIGN KEY (\`bateau_id\`) REFERENCES \`bateau\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` ADD CONSTRAINT \`FK_f208ed475a58d940db992330968\` FOREIGN KEY (\`liaison_id\`) REFERENCES \`liaison\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_c916cd663d751be99353e5232d1\` FOREIGN KEY (\`traversee_id\`) REFERENCES \`traversee\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_e219b0a4ff01b85072bfadf3fd7\` FOREIGN KEY (\`user_id\`) REFERENCES \`user\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`type\` ADD CONSTRAINT \`FK_ce832e9188ef22daf60d08c6f69\` FOREIGN KEY (\`categorie_lettre\`) REFERENCES \`categorie\`(\`lettre\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`equipement\` ADD CONSTRAINT \`FK_be953849783e4abdd1e3ad9c470\` FOREIGN KEY (\`bateauVoyageurId\`) REFERENCES \`bateau\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` ADD CONSTRAINT \`FK_c77bd1ac3d7815633ad0a44e95e\` FOREIGN KEY (\`reservation_id\`) REFERENCES \`reservation\`(\`id\`) ON DELETE CASCADE ON UPDATE CASCADE`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` ADD CONSTRAINT \`FK_349f1f97df962f636dbfc35e5e0\` FOREIGN KEY (\`type_id\`) REFERENCES \`type\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` ADD CONSTRAINT \`FK_3f7ff0073a7184b1dc1bc5d37ed\` FOREIGN KEY (\`bateau_id\`) REFERENCES \`bateau\`(\`id\`) ON DELETE CASCADE ON UPDATE CASCADE`
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` ADD CONSTRAINT \`FK_c2d984f27752fb4beeecc0b4e3e\` FOREIGN KEY (\`categorie_lettre\`) REFERENCES \`categorie\`(\`lettre\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` DROP FOREIGN KEY \`FK_c2d984f27752fb4beeecc0b4e3e\``
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` DROP FOREIGN KEY \`FK_3f7ff0073a7184b1dc1bc5d37ed\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` DROP FOREIGN KEY \`FK_349f1f97df962f636dbfc35e5e0\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` DROP FOREIGN KEY \`FK_c77bd1ac3d7815633ad0a44e95e\``
    )
    await queryRunner.query(
      `ALTER TABLE \`equipement\` DROP FOREIGN KEY \`FK_be953849783e4abdd1e3ad9c470\``
    )
    await queryRunner.query(
      `ALTER TABLE \`type\` DROP FOREIGN KEY \`FK_ce832e9188ef22daf60d08c6f69\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_e219b0a4ff01b85072bfadf3fd7\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_c916cd663d751be99353e5232d1\``
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` DROP FOREIGN KEY \`FK_f208ed475a58d940db992330968\``
    )
    await queryRunner.query(
      `ALTER TABLE \`traversee\` DROP FOREIGN KEY \`FK_e447c2cee3b4a41023032588943\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` DROP FOREIGN KEY \`FK_0a807ed929d7d7a597200e7d22f\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` DROP FOREIGN KEY \`FK_2c535b02420afed5c72485732d5\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaison\` DROP FOREIGN KEY \`FK_86bba15f1ebc026f7d975215fb2\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaisons_types_periodes\` DROP FOREIGN KEY \`FK_5b7849a8dad568791735fb1ae66\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaisons_types_periodes\` DROP FOREIGN KEY \`FK_926fdf69d04ce48f1b4db6f500a\``
    )
    await queryRunner.query(
      `ALTER TABLE \`liaisons_types_periodes\` DROP FOREIGN KEY \`FK_8d1d9ad3d716ef86889f843569b\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_c2d984f27752fb4beeecc0b4e3\` ON \`bateaux_categories\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_3f7ff0073a7184b1dc1bc5d37e\` ON \`bateaux_categories\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_349f1f97df962f636dbfc35e5e\` ON \`reservations_types\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_c77bd1ac3d7815633ad0a44e95\` ON \`reservations_types\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` DROP COLUMN \`quantite\``
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` DROP COLUMN \`capacite_max\``
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` ADD \`capacite_max\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` ADD \`quantite\` int NOT NULL`
    )
    await queryRunner.query(`DROP TABLE \`reservations_types\``)
    await queryRunner.query(`DROP TABLE \`bateaux_categories\``)
    await queryRunner.query(`DROP TABLE \`equipement\``)
    await queryRunner.query(
      `DROP INDEX \`IDX_2d13eac73f0a37a92888ddc3e6\` ON \`bateau\``
    )
    await queryRunner.query(`DROP TABLE \`bateau\``)
    await queryRunner.query(`DROP TABLE \`categorie\``)
    await queryRunner.query(`DROP TABLE \`type\``)
    await queryRunner.query(`DROP TABLE \`reservation\``)
    await queryRunner.query(
      `DROP INDEX \`IDX_e12875dfb3b1d92d7d7c5377e2\` ON \`user\``
    )
    await queryRunner.query(`DROP TABLE \`user\``)
    await queryRunner.query(`DROP TABLE \`traversee\``)
    await queryRunner.query(`DROP TABLE \`liaison\``)
    await queryRunner.query(`DROP TABLE \`liaisons_types_periodes\``)
    await queryRunner.query(`DROP TABLE \`periode\``)
    await queryRunner.query(`DROP TABLE \`port\``)
    await queryRunner.query(`DROP TABLE \`secteur\``)
  }
}
