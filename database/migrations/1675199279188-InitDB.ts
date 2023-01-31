import { MigrationInterface, QueryRunner } from "typeorm";

export class InitDB1675199279188 implements MigrationInterface {
    name = 'InitDB1675199279188'

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pAdulte\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pJunior\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pEnfant\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pFourgon\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pCC\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pCamion\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pVoiture4\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pVoiture5\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`pAnimaux\` int NOT NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD \`traverseeId\` int NULL`);
        await queryRunner.query(`ALTER TABLE \`tarif\` ADD CONSTRAINT \`FK_f82cd43339133fa074ceffc2d0b\` FOREIGN KEY (\`traverseeId\`) REFERENCES \`traversee\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`);
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP FOREIGN KEY \`FK_f82cd43339133fa074ceffc2d0b\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`traverseeId\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pAnimaux\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pVoiture5\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pVoiture4\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pCamion\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pCC\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pFourgon\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pEnfant\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pJunior\``);
        await queryRunner.query(`ALTER TABLE \`tarif\` DROP COLUMN \`pAdulte\``);
    }

}
