import {
  Column,
  Entity,
  PrimaryGeneratedColumn,
  ManyToOne,
  JoinColumn
} from 'typeorm'
import { Traversee } from './traversee'

@Entity()
export class Tarif {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  prix: number

  @Column()
  pAdulte: number

  @Column()
  pJunior: number

  @Column()
  pEnfant: number

  @Column()
  pFourgon: number

  @Column()
  pCC: number

  @Column()
  pCamion: number

  @Column()
  pVoiture4: number

  @Column()
  pVoiture5: number

  @Column()
  pAnimaux: number

  @ManyToOne(() => Traversee, (traversee) => traversee.reservations)
  @JoinColumn()
  traversee: Traversee
}
