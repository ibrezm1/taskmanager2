import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Appointment } from './models/appointment.model';
import { catchError } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class AppointmentService {
  private apiUrl = 'http://localhost/be/appointment-apiv1.php';

  constructor(private http: HttpClient) {}

  getAllAppointments(): Observable<Appointment[]> {
    return this.http.get<Appointment[]>(this.apiUrl);
  }

  addAppointment(appointment: Appointment): Observable<any> {
    console.log(appointment);
    return this.http.post<any>(this.apiUrl, appointment)
  }

  updateAppointment(appointment: Appointment): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${appointment.id}`, appointment);
  }

  deleteAppointment(id: number): Observable<any> {
    console.log(id);
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}
