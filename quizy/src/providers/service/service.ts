import { Injectable, NgZone  } from '@angular/core';
import { Geolocation, Geoposition } from '@ionic-native/geolocation';
import { BackgroundGeolocation } from '@ionic-native/background-geolocation';

/*
  Generated class for the ServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ServiceProvider {

  public  center : any;
  public usrData: any;
  public dat: any;
 
  public watch: any;   
  public lat: number = 0;
  public lng: number = 0;


  constructor(
    public geoLocation : Geolocation,
    public zone: NgZone,
    public backgroundGeolocation: BackgroundGeolocation,
    public geolocation : Geolocation) {
      this.usrData="";
      
  }

  setUserData(usrData){
      this.usrData=usrData;
  }

  setLatLon(dat){
      this.dat=dat;
  }

  getUserData() {
      return this.usrData;
  }  

  getLatLon(){
      // Background Tracking
 
  let config = {
    desiredAccuracy: 0,
    stationaryRadius: 1,
    distanceFilter: 50,
    debug: true,
    interval: 2000
  };
 
  this.backgroundGeolocation.configure(config).subscribe((location) => {
 
    console.log('BackgroundGeolocation:  ' + location.latitude + ',' + location.longitude);
 
    // Run update inside of Angular's zone
    this.zone.run(() => {
      this.lat = location.latitude;
      this.lng = location.longitude;
    });
 
  }, (err) => {
 
    console.log(err);
 
  });
 
  // Turn ON the background-geolocation system.
  this.backgroundGeolocation.start();
 
 
  // Foreground Tracking
 
let options = {
  frequency: 1500,
  enableHighAccuracy: true
};
 
this.watch = this.geolocation.watchPosition(options).filter((p: any) => p.code === undefined).subscribe((position: Geoposition) => {
 
  console.log(position);
 
  // Run update inside of Angular's zone
  this.zone.run(() => {
    this.lat = position.coords.latitude;
    this.lng = position.coords.longitude;
  });
 
});
  }
  

}
