import {
  Column,
  Entity,
  JoinColumn,
  ManyToOne,
  PrimaryGeneratedColumn
} from 'typeorm'
import { Type } from './type'
import { Traversee } from './traversee'
import { User } from './user'

@Entity()
export class Reservation {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @Column()
  prenom: string

  @Column()
  addresse: string

  @Column({ name: 'code_postal' })
  codePostal: string

  @Column()
  ville: string

  @Column()
  nbAdulte: number

  @Column()
  nbJunior: number

  @Column()
  nbEnfant: number

  @Column()
  nbFourgon: number

  @Column()
  nbCC: number

  @Column()
  nbCamion: number

  @Column()
  nbVoiture4: number

  @Column()
  nbVoiture5: number

  @Column()
  nbAnimaux: number

  @ManyToOne(() => Type, (type) => type.reservations)
  @JoinColumn()
  type: Type

  @ManyToOne(() => Traversee, (traversee) => traversee.reservations)
  @JoinColumn()
  traversee: Traversee

  @ManyToOne(() => User, (user) => user.reservations)
  @JoinColumn()
  user: User
}
