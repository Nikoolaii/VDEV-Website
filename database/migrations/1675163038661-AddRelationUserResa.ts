import { MigrationInterface, QueryRunner } from 'typeorm'

export class AddRelationUserResa1675163038661 implements MigrationInterface {
  name = 'AddRelationUserResa1675163038661'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`userId\` int NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD CONSTRAINT \`FK_529dceb01ef681127fef04d755d\` FOREIGN KEY (\`userId\`) REFERENCES \`user\`(\`id\`) ON DELETE NO ACTION ON UPDATE NO ACTION`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP FOREIGN KEY \`FK_529dceb01ef681127fef04d755d\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`userId\``
    )
  }
}
