import { MigrationInterface, QueryRunner } from 'typeorm'

export class InitDB1675189074485 implements MigrationInterface {
  name = 'InitDB1675189074485'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`user\` ADD \`admin\` tinyint NOT NULL`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(`ALTER TABLE \`user\` DROP COLUMN \`admin\``)
  }
}
