import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'

@Entity()
export class Traversee {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  date: Date

  @Column({ type: 'time' })
  heure: Date
}
