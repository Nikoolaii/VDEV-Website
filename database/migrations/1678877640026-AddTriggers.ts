import { MigrationInterface, QueryRunner } from 'typeorm'

export class AddTriggers1678877640026 implements MigrationInterface {
  name = 'AddTriggers1678877640026'

  public async up(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(
      `create definer = root@localhost trigger check_capacite_on_reservation
    before insert
    on reservations_types
    for each row
    begin
        DECLARE v_traversee_id integer;
        DECLARE v_categorie_lettre varchar(1);
        DECLARE v_capacite integer;
        DECLARE v_capacite_max integer;
    
        SELECT r.traversee_id
        INTO v_traversee_id
            FROM reservations_types
            INNER JOIN reservation r on reservations_types.reservation_id = r.id
            WHERE reservations_types.reservation_id = new.reservation_id;
    
        SELECT ty.categorie_lettre
        INTO v_categorie_lettre
            FROM reservations_types
            INNER JOIN type ty on reservations_types.type_id = ty.id
            WHERE reservations_types.reservation_id = new.reservation_id;
    
        SELECT SUM(quantite)
        INTO v_capacite
            FROM reservations_types
            INNER JOIN reservation r on reservations_types.reservation_id = r.id
            INNER JOIN type ty on reservations_types.type_id = ty.id
            INNER JOIN traversee tr on r.traversee_id = tr.id
            INNER JOIN categorie c on ty.categorie_lettre = c.lettre
            WHERE tr.id = v_traversee_id AND ty.categorie_lettre = v_categorie_lettre;
    
        SELECT capacite_max
        INTO v_capacite_max
            FROM bateaux_categories
            INNER JOIN traversee t on bateaux_categories.bateau_id = t.bateau_id
            WHERE id = v_traversee_id AND categorie_lettre = v_categorie_lettre;
    
        IF v_capacite + new.quantite > v_capacite_max THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La capacité maximale de la catégorie a été atteinte pour cette traversée.';
        END IF;
    end;`
    )

    await queryRunner.query(
      `create definer = root@localhost trigger add_user_id_in_reservation
    before insert
    on reservation
    for each row
    begin
      if new.user_id is null then
          set new.user_id = (select id from user where email = new.email);
      end if;
    end;`
    )
  }

  public async down(queryRunner: QueryRunner): Promise<void> {
    await queryRunner.query(`drop trigger add_user_id_in_reservation`)
    await queryRunner.query(`drop trigger check_capacite_on_reservation`)
  }
}
