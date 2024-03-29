import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Appointment } from './models/appointment.model';
import { environment } from './../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AppointmentService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  getAllAppointments(): Observable<Appointment[]> {
    return this.http.get<Appointment[]>(this.apiUrl);
  }

  addAppointment(appointment: Appointment): Observable<any> {
    const postData = {
      type: 'create',
      description: appointment.description,
      date: appointment.date
    };

    return this.http.post<any>(this.apiUrl, postData);
  }

  updateAppointment(appointment: Appointment): Observable<any> {
    const postData = {
      type: 'update',
      id: appointment.id,
      description: appointment.description,
      date: appointment.date
    };

    return this.http.post<any>(this.apiUrl, postData);
  }

  deleteAppointment(id: number): Observable<any> {
    const postData = {
      type: 'delete',
      id: id
    };

    return this.http.post<any>(this.apiUrl, postData);
  }
}
