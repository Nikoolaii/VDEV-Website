import { MigrationInterface, QueryRunner } from "typeorm";

export class ChangeDateType1675166051198 implements MigrationInterface {
    name = 'ChangeDateType1675166051198'

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`traversee\` DROP COLUMN \`date\``);
        await queryRunner.query(`ALTER TABLE \`traversee\` ADD \`date\` date NOT NULL`);
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`traversee\` DROP COLUMN \`date\``);
        await queryRunner.query(`ALTER TABLE \`traversee\` ADD \`date\` datetime NOT NULL`);
    }

}
