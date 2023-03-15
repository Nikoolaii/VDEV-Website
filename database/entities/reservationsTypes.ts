import { Column, Entity, PrimaryColumn } from 'typeorm'

@Entity('reservations_types')
export class ReservationsTypes {
  @PrimaryColumn({ name: 'reservation_id' })
  reservationId: number

  @PrimaryColumn({ name: 'type_id' })
  typeId: number

  @Column()
  quantite: number
}
