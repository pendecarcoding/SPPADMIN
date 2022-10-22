import 'package:flutter/material.dart';
import 'package:spp/theme/colors/light_colors.dart';

class health extends StatefulWidget {
  const health({Key? key}) : super(key: key);

  @override
  State<health> createState() => _health();
}

class _health extends State<health> {
  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return Scaffold(
      appBar: AppBar(
        title: Text("Monitoring Kesehatan"),
        backgroundColor: LightColors.Blue,
      ),
      body: Center(child: Text("MOnitoring Kesehatan")),
    );
  }
}
