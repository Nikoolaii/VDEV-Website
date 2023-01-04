import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'

@Entity()
export class Bateau {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @Column()
  longueur: number

  @Column()
  largeur: number

  @Column()
  vitesse: number
}
