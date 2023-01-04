import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'

@Entity()
export class Tarif {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  prix: number
}
