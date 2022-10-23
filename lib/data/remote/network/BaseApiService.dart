abstract class BaseApiService {
  final String baseUrl = "https://spp.kanalapps.web.id/api/";

  Future<dynamic> getResponse(String url);
}
