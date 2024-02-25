import { Component,OnInit } from '@angular/core';
// import the common module
import { CommonModule } from '@angular/common';
import { Appointment } from '../models/appointment.model';
import { AppointmentFormComponent } from './appointment-form/appointment-form.component';
import { AppointmentService } from '../appointment.service';

@Component({
  selector: 'app-appointment-list',
  standalone: true,
  imports: [CommonModule,AppointmentFormComponent],
  templateUrl: './appointment-list.component.html',
  styleUrl: './appointment-list.component.css'
})
export class AppointmentListComponent implements OnInit {
  appointments: Appointment[] = [];

  constructor(private appointmentService: AppointmentService) {}


  ngOnInit(): void {
    // Retrieve appointments from local storage
    this.fetchAppointments();
  }

  onAppointmentCreated(appointment: Appointment): void {
    appointment.id = this.appointments.length + 1;
    //console.log(appointment);
    this.appointmentService.addAppointment(appointment).subscribe(
      data => {
        console.log(data.message);
        this.fetchAppointments();
      },)
  }

  deleteAppointment(id:number): void {
    this.appointmentService.deleteAppointment(id).subscribe(
      data => {
        console.log(data.message);
        this.fetchAppointments();
      },)
  }

  private fetchAppointments(): void {
    // Retrieve appointments from the server
    this.appointmentService.getAllAppointments().subscribe((appointments) => {
      this.appointments = appointments;
    });
  }


}
