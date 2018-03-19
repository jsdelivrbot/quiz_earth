import { Component, ViewChild, ElementRef } from '@angular/core';
import { NavController } from 'ionic-angular';
import { LocationTrackerProvider } from '../../providers/location-tracker/location-tracker';
import { Geolocation } from '@ionic-native/geolocation';
import L from 'leaflet';
import { Http } from '@angular/http';


@Component({
  selector: 'page-about',
  templateUrl: 'about.html'
})
export class AboutPage {
 
}