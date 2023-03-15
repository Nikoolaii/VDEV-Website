import { MigrationInterface, QueryRunner } from 'typeorm'

export class AddEmail1678870593918 implements MigrationInterface {
  name = 'AddEmail1678870593918'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`email\` varchar(255) NOT NULL`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(`ALTER TABLE \`reservation\` DROP COLUMN \`email\``)
  }
}
