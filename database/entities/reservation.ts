import {
  Column,
  Entity,
  JoinColumn,
  JoinTable,
  ManyToMany,
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
  adresse: string

  @Column({ name: 'code_postal' })
  codePostal: string

  @Column()
  ville: string

  @Column()
  email: string

  @ManyToMany(() => Type, (type) => type.reservations, {
    onDelete: 'CASCADE'
  })
  @JoinTable({
    name: 'reservations_types',
    joinColumn: {
      name: 'reservation_id',
      referencedColumnName: 'id'
    },
    inverseJoinColumn: {
      name: 'type_id',
      referencedColumnName: 'id'
    }
  })
  types: Type[]

  @ManyToOne(() => Traversee, (traversee) => traversee.reservations, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'traversee_id' })
  traversee: Traversee

  @ManyToOne(() => User, (user) => user.reservations, {
    nullable: true,
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'user_id' })
  user: User
}
