import { MigrationInterface, QueryRunner } from 'typeorm'

export class ChangeTypeFloat1677783892140 implements MigrationInterface {
  name = 'ChangeTypeFloat1677783892140'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` DROP FOREIGN KEY \`FK_3f7ff0073a7184b1dc1bc5d37ed\``
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` DROP FOREIGN KEY \`FK_c2d984f27752fb4beeecc0b4e3e\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` DROP FOREIGN KEY \`FK_349f1f97df962f636dbfc35e5e0\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` DROP FOREIGN KEY \`FK_c77bd1ac3d7815633ad0a44e95e\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_3f7ff0073a7184b1dc1bc5d37e\` ON \`bateaux_categories\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_c2d984f27752fb4beeecc0b4e3\` ON \`bateaux_categories\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_c77bd1ac3d7815633ad0a44e95\` ON \`reservations_types\``
    )
    await queryRunner.query(
      `DROP INDEX \`IDX_349f1f97df962f636dbfc35e5e\` ON \`reservations_types\``
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
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`poidsMax\``)
    await queryRunner.query(
      `ALTER TABLE \`bateau\` ADD \`poidsMax\` float NULL`
    )
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`longueur\``)
    await queryRunner.query(
      `ALTER TABLE \`bateau\` ADD \`longueur\` float NULL`
    )
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`largeur\``)
    await queryRunner.query(`ALTER TABLE \`bateau\` ADD \`largeur\` float NULL`)
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`vitesse\``)
    await queryRunner.query(`ALTER TABLE \`bateau\` ADD \`vitesse\` float NULL`)
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
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`vitesse\``)
    await queryRunner.query(`ALTER TABLE \`bateau\` ADD \`vitesse\` int NULL`)
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`largeur\``)
    await queryRunner.query(`ALTER TABLE \`bateau\` ADD \`largeur\` int NULL`)
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`longueur\``)
    await queryRunner.query(`ALTER TABLE \`bateau\` ADD \`longueur\` int NULL`)
    await queryRunner.query(`ALTER TABLE \`bateau\` DROP COLUMN \`poidsMax\``)
    await queryRunner.query(`ALTER TABLE \`bateau\` ADD \`poidsMax\` int NULL`)
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
      `CREATE INDEX \`IDX_349f1f97df962f636dbfc35e5e\` ON \`reservations_types\` (\`type_id\`)`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_c77bd1ac3d7815633ad0a44e95\` ON \`reservations_types\` (\`reservation_id\`)`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_c2d984f27752fb4beeecc0b4e3\` ON \`bateaux_categories\` (\`categorie_lettre\`)`
    )
    await queryRunner.query(
      `CREATE INDEX \`IDX_3f7ff0073a7184b1dc1bc5d37e\` ON \`bateaux_categories\` (\`bateau_id\`)`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` ADD CONSTRAINT \`FK_c77bd1ac3d7815633ad0a44e95e\` FOREIGN KEY (\`reservation_id\`) REFERENCES \`reservation\`(\`id\`) ON DELETE CASCADE ON UPDATE CASCADE`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservations_types\` ADD CONSTRAINT \`FK_349f1f97df962f636dbfc35e5e0\` FOREIGN KEY (\`type_id\`) REFERENCES \`type\`(\`id\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` ADD CONSTRAINT \`FK_c2d984f27752fb4beeecc0b4e3e\` FOREIGN KEY (\`categorie_lettre\`) REFERENCES \`categorie\`(\`lettre\`) ON DELETE CASCADE ON UPDATE NO ACTION`
    )
    await queryRunner.query(
      `ALTER TABLE \`bateaux_categories\` ADD CONSTRAINT \`FK_3f7ff0073a7184b1dc1bc5d37ed\` FOREIGN KEY (\`bateau_id\`) REFERENCES \`bateau\`(\`id\`) ON DELETE CASCADE ON UPDATE CASCADE`
    )
  }
}
