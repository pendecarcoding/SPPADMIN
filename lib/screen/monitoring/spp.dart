import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:spp/theme/colors/light_colors.dart';

class spp extends StatefulWidget {
  const spp({Key? key}) : super(key: key);

  @override
  State<spp> createState() => _spp();
}

class _spp extends State<spp> {
  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return Scaffold(
      appBar: AppBar(
        title: Text("Monitoring SPP"),
        backgroundColor: LightColors.Blue,
      ),
    );
  }
}
