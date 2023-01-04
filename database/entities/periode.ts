import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'

@Entity()
export class Periode {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  debut: Date

  @Column()
  fin: Date
}
