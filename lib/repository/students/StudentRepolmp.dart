import 'package:spp/models/students/StudentModel.dart';
import 'package:spp/repository/students/StudentsRepo.dart';

import '../../data/remote/network/ApiEndPoints.dart';
import '../../data/remote/network/BaseApiService.dart';
import '../../data/remote/network/NetworkApiService.dart';

class StudentRepolmp implements StudentsRepo {
  BaseApiService _apiService = NetworkApiService();

  @override
  Future<StudentModel> getStudents() async {
    try {
      dynamic response =
          await _apiService.getResponse(ApiEndPoints().getstudent);
      print("MARAJ $response");
      final jsonData = StudentModel.fromJson(response);
      return jsonData;
    } catch (e) {
      throw e;
      print("MARAJ-E $e}");
    }
  }
}
