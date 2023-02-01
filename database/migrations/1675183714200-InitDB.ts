import { MigrationInterface, QueryRunner } from 'typeorm'

export class InitDB1675183714200 implements MigrationInterface {
  name = 'InitDB1675183714200'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`liaison\` ADD \`imglink\` varchar(255) NOT NULL`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(`ALTER TABLE \`liaison\` DROP COLUMN \`imglink\``)
  }
}
