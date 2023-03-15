import { Column, Entity, JoinColumn, ManyToOne, PrimaryColumn } from 'typeorm'
import { Periode } from './periode'
import { Liaison } from './liaison'
import { Type } from './type'

@Entity('liaisons_types_periodes')
export class LiaisonsTypesPeriodes {
  @ManyToOne(() => Liaison, (liaison) => liaison.laisonsTypesPeriodes, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'liaison_id' })
  liaison: Liaison

  @PrimaryColumn({ name: 'liaison_id' })
  liaisonId: number

  @ManyToOne(() => Type, (type) => type.laisonsTypesPeriodes, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'type_id' })
  type: Type

  @PrimaryColumn({ name: 'type_id' })
  typeId: number

  @ManyToOne(() => Periode, (periode) => periode.laisonsTypesPeriodes, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'periode_id' })
  periode: Periode

  @PrimaryColumn({ name: 'periode_id' })
  periodeId: number

  @Column({ type: 'float' })
  tarif: number
}
