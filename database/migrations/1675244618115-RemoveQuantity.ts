import { MigrationInterface, QueryRunner } from "typeorm";

export class RemoveQuantity1675244618115 implements MigrationInterface {
    name = 'RemoveQuantity1675244618115'

    public async up(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`reservation\` DROP COLUMN \`quantite\``);
    }

    public async down(queryRunner: QueryRunner): Promise<void> {
        await queryRunner.query(`ALTER TABLE \`reservation\` ADD \`quantite\` int NOT NULL`);
    }

}
