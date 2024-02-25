import { Component } from '@angular/core';
import { Appointment } from '../../models/appointment.model';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { EventEmitter,Output } from '@angular/core';


@Component({
  selector: 'app-appointment-form',
  standalone: true,
  imports: [FormsModule,CommonModule],
  templateUrl: './appointment-form.component.html',
  styleUrl: './appointment-form.component.css'
})
export class AppointmentFormComponent {
   description: string='';
   date: Date=new Date();
   @Output() appointmentCreated: EventEmitter<Appointment> = new EventEmitter<Appointment>();

  constructor() {}

  emitAppointment(): void {
    // Perform any necessary validation or processing on the appointment data
    let appointment:Appointment = new Appointment(0, this.description, this.date);
    this.appointmentCreated.emit(appointment);
    console.log(this.description, this.date)
  }


}
