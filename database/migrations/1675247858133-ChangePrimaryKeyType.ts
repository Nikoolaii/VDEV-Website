import { MigrationInterface, QueryRunner } from "typeorm";

export class ChangePrimaryKeyType1675247858133 implements MigrationInterface {
    name = 'ChangePrimaryKeyType1675247858133'

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_8a49f5ec716289d21900a123592\``);
        await queryRunner.query(`ALTER TABLE \`reservation\` DROP COLUMN \`typeId\``);
        await queryRunner.query(`ALTER TABLE \`reservation\` ADD \`typeId\` int NULL`);
        await queryRunner.query(`ALTER TABLE \`type\` DROP PRIMARY KEY`);
        await queryRunner.query(`ALTER TABLE \`type\` DROP COLUMN \`id\``);
        await queryRunner.query(`ALTER TABLE \`type\` ADD \`id\` int NOT NULL PRIMARY KEY AUTO_INCREMENT`);
        await queryRunner.query(`ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_8a49f5ec716289d21900a123592\` FOREIGN KEY (\`typeId\`) REFERENCES \`type\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`);
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_8a49f5ec716289d21900a123592\``);
        await queryRunner.query(`ALTER TABLE \`type\` DROP COLUMN \`id\``);
        await queryRunner.query(`ALTER TABLE \`type\` ADD \`id\` varchar(255) NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`type\` ADD PRIMARY KEY (\`id\`)`);
        await queryRunner.query(`ALTER TABLE \`reservation\` DROP COLUMN \`typeId\``);
        await queryRunner.query(`ALTER TABLE \`reservation\` ADD \`typeId\` varchar(255) NULL`);
        await queryRunner.query(`ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_8a49f5ec716289d21900a123592\` FOREIGN KEY (\`typeId\`) REFERENCES \`type\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`);
    }

}
