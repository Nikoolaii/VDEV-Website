import { MigrationInterface, QueryRunner } from 'typeorm'

export class InitDB1675198111800 implements MigrationInterface {
  name = 'InitDB1675198111800'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbAdulte\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbJunior\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbEnfant\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbFourgon\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbCC\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbCamion\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbVoiture4\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbVoiture5\` int NOT NULL`
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` ADD \`nbAnimaux\` int NOT NULL`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbAnimaux\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbVoiture5\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbVoiture4\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbCamion\``
    )
    await queryRunner.query(`ALTER TABLE \`reservation\` DROP COLUMN \`nbCC\``)
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbFourgon\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbEnfant\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbJunior\``
    )
    await queryRunner.query(
      `ALTER TABLE \`reservation\` DROP COLUMN \`nbAdulte\``
    )
  }
}
