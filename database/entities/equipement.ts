import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'

@Entity()
export class Equipement {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string
}
