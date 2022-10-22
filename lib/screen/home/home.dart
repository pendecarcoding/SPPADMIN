import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class home extends StatefulWidget {
  const home({Key? key}) : super(key: key);

  @override
  State<home> createState() => _home();
}

class _home extends State<home> {
  @override
  Widget build(Object context) {
    // TODO: implement build
    return (Scaffold(
      appBar: AppBar(
        title: Text("BeQuraniq APP"),
        backgroundColor: Colors.amber,
      ),
      body: Container(
        color: Colors.amber,
      ),
    ));
  }
}
