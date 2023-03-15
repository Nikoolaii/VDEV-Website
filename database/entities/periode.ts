import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm'
import { LiaisonsTypesPeriodes } from './liaisonsTypesPeriodes'

@Entity()
export class Periode {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  debut: Date

  @Column()
  fin: Date

  @OneToMany(() => LiaisonsTypesPeriodes, (ltp) => ltp.periode)
  laisonsTypesPeriodes: LiaisonsTypesPeriodes[]
}
