import { Component, ViewChild, ElementRef } from '@angular/core';
import { NavController } from 'ionic-angular';
import { LocationTrackerProvider } from '../../providers/location-tracker/location-tracker';
import { Geolocation } from '@ionic-native/geolocation';
import L from 'leaflet';
import { Http } from '@angular/http';



@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  @ViewChild('map')mapContainer : ElementRef;
  map : L.map;  
  center : any;
  marker : any;
  circle : any;


  constructor(public navCtrl: NavController, 
    public locationTracker: LocationTrackerProvider,
    public geoLocation : Geolocation) {
 
  }


  // start(){
  //   this.locationTracker.startTracking();
  // }
 
  // stop(){
  //   this.locationTracker.stopTracking();
  // }
 
  ionViewDidLoad() {
    this.loadMap();
  }  

  loadMap() {
   
    this.geoLocation.getCurrentPosition().then((res) => {
      this.center = [res.coords.latitude  , res.coords.longitude];      
      let pos = [res.coords.latitude  , res.coords.longitude];



      let mapOption = {
        center: this.center,
        zoom: 15
      };
  
      this.map = L.map('map', mapOption);
      this.marker = L.marker();
  
      L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attributions: 'OSM',
        maxZoom: 20
      }).addTo(this.map);
  


      var LeafIcon = L.Icon.extend({
        options: {
          iconSize:     [30, 40], // size of the icon
          iconAnchor:   [10, 30]
        }
      });
    
      var greenIcon = new LeafIcon({iconUrl: 'http://icon-park.com/imagefiles/location_map_pin_orange3.png'});
 
  

      this.marker = L.marker(pos, {icon: greenIcon}).bindPopup('Hello').addTo(this.map);
      this.circle = L.circle(pos, {radius: 500}).addTo(this.map);        


      doGET() {
        console.log("GET");
        let url = `${this.apiRoot}/get`;
        this.http.get(url).subscribe(res => console.log(res.text())); 
      }
    


    




    })
  
  } 
 
}